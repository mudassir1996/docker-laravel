<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Models\DataSync;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Outlet;
use App\Models\ProductMeta;
use App\Models\ProductStock;
use App\Models\ProductVariation;
use App\Models\Sales\SalesOrderDetail;
use App\Models\Variation;
use App\Models\VariationAttribute;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('products_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $products = Product::select('products.*', 'companies.company_title', 'categories.category_title', 'outlets.outlet_title', 'employees.employee_name', 'product_stocks.units_in_stock', 'product_stocks.retail_price')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.id')
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->leftJoin('employees', 'products.created_by', '=', 'employees.id')
            ->where('products.outlet_id', session('outlet_id'))
            ->orderBy('products.created_at', 'desc')
            ->get();
        // dd($products);

        return view('pages.product.manage_products', compact('products'));
    }



    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function manage()
    // {
    //     abort_if(Gate::denies('products_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     if (!Auth::guard('web')->check()) {
    //         abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     }
    //     //selecting all rows from products
    //     $products = DB::table('products')
    //         ->select('products.*', 'companies.company_title', 'categories.category_title', 'outlets.outlet_title', 'users.username')
    //         ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
    //         ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
    //         ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.id')
    //         ->leftJoin('users', 'products.created_by', '=', 'users.id')
    //         ->where('products.outlet_id', session('outlet_id'))
    //         ->get();
    //     //passing data to the view
    //     return view('pages.product.manage_products', compact('products'));
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('products_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //loading add product view

        // $variations = Variation::where('outlet_id', session('outlet_id'))->get();
        // $variation_attributes = VariationAttribute::where('outlet_id', session('outlet_id'))->pluck('value', 'id');
        $suppliers = DB::table('suppliers')->where('outlet_id', session('outlet_id'))->select('id', 'supplier_title')->latest()->get();
        $companies = DB::table('companies')->where('outlet_id', session('outlet_id'))->select('id', 'company_title')->latest()->get();
        $categories = DB::table('categories')->where('outlet_id', session('outlet_id'))->select('id', 'category_title')->latest()->get();
        $previous_page = URL::previous();
        $outlet = Outlet::where('id', session('outlet_id'))->first();
        $custom_fields = DB::table('custom_fields')
            ->where('business_type_id', $outlet->business_type_id)
            ->where('status', 'active')
            ->get();

        // dd($suppliers);

        return view('pages.product.add_product', compact('companies', 'custom_fields', 'suppliers', 'categories', 'previous_page'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        // dd($request->all());
        $request->validate(
            [
                'product_title' => [
                    'required', Rule::unique('products')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ],
                'product_barcode' => [
                    'required', Rule::unique('products')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ],

                'category_id' => 'required',
                'company_id' => 'required',
                'product_feature_img' => 'max:2048'
            ],
            [
                'product_title.required' => 'Product title is required',
                'product_barcode.required' => 'Product barcode is required',
                'category_id.required' => 'Please select a category',
                'company_id.required' => 'Please select a company',
            ]
        );

        if ($request->stock_keeping == null) {

            $request->validate(
                [
                    'retail_price' => 'required|numeric|gte:0',
                    'cost_price' => 'required|numeric|gte:0',
                ],
                [
                    'retail_price.required' => 'Retail Price is required',
                    'retail_price.numeric' => 'The value is not a number',
                    'retail_price.gte' => 'The value must be greater than or equal to 0',
                    'cost_price.required' => 'Cost Price is required',
                    'cost_price.numeric' => 'The value is not a number',
                    'cost_price.gte' => 'The value must be greater than or equal to 0',
                ]
            );
        }

        if ($request->hasFile('product_feature_img')) {
            //getting the image name
            $image_full_name = $request->product_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->product_feature_img->storeAs('products', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }
        $product_id = '';

        $product = new Product(
            [
                'product_title' => $request->get('product_title'),
                'product_description' => $request->get('product_description'),
                'product_barcode' => $request->get('product_barcode'),
                'product_allow_half' => $request->get('product_allow_half')  ?? 0,
                'product_status' => $request->get('product_status'),
                'product_feature_img' => $image_name,
                'category_id' => $request->get('category_id'),
                'company_id' => $request->get('company_id'),
                'outlet_id' => $request->get('outlet_id'),
                'created_by' => $request->get('created_by')
            ]
        );
        DB::transaction(function () use ($request, $product) {
            $product->save();
            // $product_id = $product->id;
            //adding data to products

            if ($request->custom_field_id != '') {
                $custom_field_id[] = 0;
                $custom_field_value[] = 0;
                $i = 0;
                foreach ($request->custom_field_id as $id) {
                    $custom_field_id[$i] = $id;
                    $i++;
                }
                $i = 0;
                foreach ($request->custom_field_value as $value) {
                    $custom_field_value[$i] = $value;
                    $i++;
                }

                for ($i = 0; $i < count($request->custom_field_id); $i++) {
                    $product_meta = new ProductMeta(
                        [
                            'product_id' => $product->id,
                            'custom_field_id' => $custom_field_id[$i],
                            'value' => $custom_field_value[$i],
                            'outlet_id' => $request->get('outlet_id'),
                        ]
                    );
                }
                $product_meta->save();
            }

            //  $product_id=$product->id;
            if ($request->stock_keeping == '') {
                $product_stock = ProductStock::create([
                    'product_id' => $product->id,
                    'cost_price' => $request->get('cost_price'),
                    'retail_price' => $request->get('retail_price'),
                    'stock_keeping' => $request->get('stock_keeping') ?? 0,
                    'units_in_stock' => 1,
                    'sku' => 0,
                    'minimum_threshold' => 0,
                    'outlet_id' => $request->get('outlet_id'),
                    'created_by' => $request->get('created_by')
                ]);
            } else if ($request->stock_keeping != '') {
                $minimum_threshold = $request->minimum_threshold == 0 ? 1 : $request->minimum_threshold;
                $product_stock = ProductStock::create([
                    'product_id' => $product->id,
                    'cost_price' => 0,
                    'retail_price' => 0,
                    'stock_keeping' => $request->get('stock_keeping') ?? 0,
                    'units_in_stock' => 0,
                    'sku' =>  $request->sku ?? 0,
                    'minimum_threshold' => $minimum_threshold ?? 1,
                    'outlet_id' => $request->get('outlet_id'),
                    'created_by' => $request->get('created_by')
                ]);
            }
        });

        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Product added successfully!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        if ($request->submit_btn != null) {
            return back()->with($notification);
        } else {
            return redirect('outlets/product-stock/create')->with(['product_id' => $product->id], ['product_allow_half' => $product->product_allow_half]);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('products_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $product = Product::select('products.*', 'product_stocks.retail_price', 'product_stocks.units_in_stock', 'product_stocks.stock_keeping', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('employees', 'products.created_by', '=', 'employees.id')
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.id')
            ->leftJoin('product_stocks', 'product_stocks.product_id', 'products.id')
            ->where('products.outlet_id', session('outlet_id'))
            ->where('products.id', $id)
            ->firstOrFail();


        $purchase_order_details = InventoryPurchaseOrderDetail::where('product_id', $id)->get();
        $sales_order_details = SalesOrderDetail::where('product_id', $id)->get();

        return view('pages.product.view_product', compact('product', 'sales_order_details', 'purchase_order_details'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('products_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }


        $companies = Company::where('outlet_id', session('outlet_id'))->get();
        $categories = Category::where('outlet_id', session('outlet_id'))->get();
        // $previous_page = URL::previous();

        $product = Product::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();

        if (!$product) {
            //setting up error message
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
            //redirecting to the page with notification message
            return redirect()->back()->with($notification);
        }



        // dd($previous_page);
        return view('pages.product.edit_product', compact('product', 'companies', 'categories'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //changing data of specific id
        $product = Product::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();

        //setting image to ''
        $image_name = "";

        //checking if allow half is checked or not
        $allow_half = $request->get('product_allow_half');
        if ($allow_half != 1) {
            $allow_half = 0;
        }
        $request->validate(
            [

                'product_title' => [
                    'required', Rule::unique('products')->where(function ($query) use ($id) {
                        $query->where('outlet_id', session('outlet_id'))
                            ->where('id', '!=', $id);
                    })
                ],
                'product_barcode' => [
                    'required', Rule::unique('products')->where(function ($query) use ($id) {
                        $query->where('outlet_id', session('outlet_id'))
                            ->where('id', '!=', $id);
                    })
                ],
                'category_id' => 'required',
                'company_id' => 'required',
                'product_feature_img' => 'mimes:jpg,png|max:2048'

            ],
            [
                'product_title.required' => 'Product title is required',
                'product_barcode.required' => 'Product barcode is required',
                'category_id.required' => 'Please select a category',
                'company_id.required' => 'Please select a company',

            ]
        );

        //checking if image has selected 
        if ($request->hasFile('product_feature_img')) {

            //deleting the previous Image
            Storage::disk('public')->delete('products/' . $product->product_feature_img);

            //getting the image name
            $image_full_name = $request->product_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->product_feature_img->storeAs('products', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $product->product_feature_img;
        }

        //updating values in database
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_barcode = $request->product_barcode;
        $product->product_allow_half = $request->product_allow_half ?? 0;
        $product->product_status = $request->product_status;
        $product->product_feature_img = $image_name;
        $product->category_id = $request->category_id;
        $product->company_id = $request->company_id;
        $product->outlet_id = $request->outlet_id;
        $product->created_by = $request->created_by;

        if ($product->save()) {
            //setting up success message
            $notification = array(
                'message' => 'Changes Saved!',
                'alert-type' => 'success'
            );
        } else {
            //setting up error message
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('outlets/products')->with($notification);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('products_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //selecting the specific id row for deleting from db
        $product = Product::where('id', $id)
            ->where('outlet_id', session('outlet_id'))->firstOrFail();

        if (
            count($product->product_stocks) > 0 || count($product->product_metas) > 0 ||
            count($product->variation_attribute) > 0 || count($product->sales_order_details) > 0
            || count($product->purchase_order_details) > 0
        ) {
            $notification = array(
                'message' => 'Product is already in use!',
                'alert-type' => 'error'
            );
            return redirect('/outlets/products')->with($notification);
        }

        //deleting the image from the storage
        if ($product->product_feature_img != 'placeholder.jpg') {
            Storage::disk('public')->delete('products/' . $product->product_feature_img);
        }

        DB::transaction(function () use ($id, $product) {
            if ($product->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'products',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });


        //setting up success message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Product Deleted!',
                'alert-type' => 'success'
            );
        }
        //setting up error message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('outlets/products')->with($notification);
    }



    /**
     * Get the cost price of selected product in po
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */

    public function get_cost(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('po_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $old_cost = DB::table('product_stocks')->where('product_id', $request->product_id)->pluck('cost_price');
        return response()->json($old_cost);
    }



    /**
     * Product Search Sales Dashboard
     *
     * @param  Request $request
     * Return products in table
     **/
    public function live_search(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('sales_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if ($request->ajax()) {
            $output = '';

            if ($request->input('query')) {
                $query = urldecode($request->input('query'));

                // return $query;
                $search_result = DB::table('products')
                    ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
                    ->where('products.product_title', 'like', '%' . $query . '%')
                    ->where('products.product_status', 'active')
                    // ->where('product_stocks.units_in_stock', '>', '0')
                    ->where('products.outlet_id', session('outlet_id'))
                    ->get();
                // return $search_result;
            } else if ($request->input('barcode')) {
                $barcode = urlencode($request->input('barcode'));
                // $keys = explode('+', $query);
                // return $keys;
                $search_result = DB::table('products')
                    ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
                    ->where('products.product_barcode', $barcode)
                    // ->Where('products.product_barcode', 'like', '%' . $query . '%')
                    ->where('products.product_status', 'active')
                    // ->where('product_stocks.units_in_stock', '>', '0')
                    ->where('products.outlet_id', session('outlet_id'))
                    ->get();

                $result['search_result'] = $search_result;
                return response()->json($result);
            }

            // return $search_result;
            if ($search_result->isEmpty()) {
                $output .= '<div class="col-md-12 col-12 col-lg-12 col-xxl-12">' .
                    '<div class="card card-custom card-shadowless">' .
                    '<div class="card-body p-0">' .
                    '<h4 class="text-muted">Product not Found...</h4>' .
                    '</div>' .
                    '</div>' .
                    '</div>' .
                    '</div>';
            } else {
                foreach ($search_result as $key => $product) {
                    if ($product->units_in_stock < $product->minimum_threshold) {
                        $text_class = 'text-danger';
                    } else {
                        $text_class = 'text-muted';
                    }
                    $output .= '<tr>' .
                        '<td class="font-weight-bolder">' . $product->product_title . '</td>' .
                        '<td class="font-weight-bolder">' . $product->product_barcode . '</td>' .
                        '<td class="font-weight-bolder">' . $product->retail_price . '</td>' .
                        '<td class="font-weight-bolder">' .
                        '<span class="' . $text_class . ' ml-2">(' . $product->units_in_stock . ')</span>' .
                        '</td>' .
                        '<td class="font-weight-bolder">' .
                        '<a href="#" onclick="select_product(' . $key . ')" class="btn font-weight-bolder btn-sm btn-outline-primary mr-2 px-10">Add</a>' .
                        '</td>' .
                        '</tr>';
                }
            }

            $result['output'] = $output;
            $result['search_result'] = $search_result;

            return response()->json($result);
        }
    }

    // public function autocomplete(Request $request)
    // {
    //     $query = $request->input('query');
    //     $datas = Product::select('product_title as name', 'product_feature_img as image')->where('product_title', 'LIKE', '%' . $query . '%')->get();
    //     return response()->json($datas);
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function file_import(Request $request)
    {
        // dd($request->file('file')->store('temp'));
        Excel::import(new ProductImport, $request->file('file')->store('temp'));
        return back();
    }


    public function get_standard_product()
    {
        $outlet = Outlet::where('id', session('outlet_id'))->select('business_type_id', 'outlet_country')->first();
        $standard_products = DB::table('standard_products')
            ->where('business_type_id', $outlet->business_type_id)
            ->where('country_id', $outlet->outlet_country)
            ->get();

        return view('pages.product.import_standard_products', compact('standard_products'));
    }
    public function store_standard_product(Request $request)
    {
        DB::transaction(function () use ($request) {
            $standard_products = DB::table('standard_products')->whereIn('id', $request->product_id)->get();
            foreach ($standard_products as $standard_product) {
                $category = Category::firstOrCreate(
                    [
                        'category_title' => $standard_product->category,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'category_title' => $standard_product->category,
                        'category_feature_img' => 'placeholder.jpg',
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
                $company = Company::firstOrCreate(
                    [
                        'company_title' => $standard_product->company,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'company_title' => $standard_product->company,
                        'company_feature_img' => 'placeholder.jpg',
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
                $product = Product::firstOrCreate(
                    [
                        'product_title' => $standard_product->product_title,
                        'product_barcode' => $standard_product->product_barcode,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'product_title' => $standard_product->product_title,
                        'product_barcode' => $standard_product->product_barcode,
                        'product_description' => $standard_product->product_description,
                        'category_id' => $category->id,
                        'company_id' => $company->id,
                        'product_status' => $standard_product->status,
                        'product_allow_half' => $standard_product->product_allow_half,
                        'product_feature_img' => $standard_product->featured_img,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
                if ($product->wasRecentlyCreated) {
                    ProductStock::create([
                        'product_id' => $product->id,
                        'cost_price' => $standard_product->cost_price,
                        'retail_price' => $standard_product->retail_price,
                        'stock_keeping' => $standard_product->stock_keeping,
                        'units_in_stock' => 0,
                        'sku' => 0,
                        'minimum_threshold' => 0,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]);
                }
            }
        });
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Products Imported',
                'alert-type' => 'success'
            );
            //setting up succes message
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Product Search Sales Dashboard
     *
     * @param  Request $request
     * Return products in table
     **/
    public function products_in_cart(Request $request)
    {

        $product =  DB::table('products')->where('products.id', $request->input('query'))
            ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('products.product_status', 'active')
            // ->where('product_stocks.units_in_stock', '>', '0')
            ->where('products.outlet_id', session('outlet_id'))
            ->first();


        return response()->json([
            'item' => $product,
        ]);
    }
}
