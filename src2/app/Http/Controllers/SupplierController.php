<?php

namespace App\Http\Controllers;

use App\Imports\SupplierImport;
use App\Models\Supplier;
use App\Models\Company;
use App\Models\DataSync;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\SupplierCompany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $suppliers = Supplier::with(['company'])
            ->select('suppliers.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'suppliers.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'suppliers.created_by', '=', 'employees.id')
            ->where('suppliers.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        return view('pages.supplier.suppliers', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $companies = Company::where('outlet_id', session('outlet_id'))->pluck('company_title', 'id');
        return view('pages.supplier.add_supplier', compact('companies'));
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
            abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if ($request->result_supplier_public_key) {
            DB::transaction(function () use ($request) {


                $supplier_outlet = Outlet::where('is_supplier', 1)
                    ->where('public_key', $request->result_supplier_public_key)
                    ->where('outlet_phone', $request->result_supplier_phone)
                    ->select('id', 'outlet_title', 'outlet_phone', 'outlet_feature_img')
                    ->first();
                // dd($supplier_outlet);

                if (Supplier::where('supplier_outlet_id', $supplier_outlet->id)->where('outlet_id', session('outlet_id'))->first()) {
                    $notification = array(
                        'message' => 'Supplier already exists!',
                        'alert-type' => 'error'
                    );

                    //redirecting to the page with notification message
                    return redirect('/outlets/suppliers/create')->with($notification);
                }



                $supplier = new Supplier(
                    [
                        'supplier_outlet_id' => $supplier_outlet->id,
                        'supplier_title' => $supplier_outlet->outlet_title,
                        'supplier_phone' => $supplier_outlet->outlet_phone,
                        'supplier_feature_img' => $supplier_outlet->outlet_feature_img,
                        'created_by' => session('employee_id'),
                        'outlet_id' => session('outlet_id'),
                    ]
                );

                if ($supplier_outlet->outlet_feature_img != 'placeholder.jpg' && $supplier->save() && !Storage::disk('public')->exists('suppliers/' . $supplier_outlet->outlet_feature_img)) {
                    Storage::disk('public')->copy('outlets/' . $supplier_outlet->outlet_feature_img, 'suppliers/' . $supplier_outlet->outlet_feature_img);
                }
                if (!empty($request->company_title)) {
                    foreach ($request->company_title as $company_title) {
                        $companies = Company::firstOrCreate([
                            'company_title' => $company_title,
                            'company_feature_img' => 'placeholder.jpg',
                            'created_by' => session('employee_id'),
                            'outlet_id' => session('outlet_id')
                        ]);
                        $supplier->company()->attach($companies->id);

                        // $supplier->company()->sync($request->input($companies->id));
                    }
                }
            });

            $notification = array(
                'message' => 'Supplier added successfully!',
                'alert-type' => 'success'
            );

            //redirecting to the page with notification message
            return redirect('/outlets/suppliers/create')->with($notification);
        }

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'supplier_title' => 'required',
                'supplier_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'supplier_title.required' => 'Supplier title is required.',
            ]
        );

        if ($request->hasFile('supplier_feature_img')) {
            //getting the image name
            $image_full_name = $request->supplier_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->supplier_feature_img->storeAs('suppliers', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }


        //adding data to products
        $supplier = Supplier::create(
            [
                'supplier_title' => $request->get('supplier_title'),
                'supplier_address' => $request->get('supplier_address'),
                'supplier_cnic' => $request->get('supplier_cnic'),
                'supplier_email' => $request->get('supplier_email'),
                'supplier_phone' => $request->get('supplier_phone'),
                'supplier_description' => $request->get('supplier_description'),
                'supplier_feature_img' => $image_name,
                'outlet_id' => $request->get('outlet_id'),
                'created_by' => $request->get('created_by')
            ]
        );
        if (!empty($request->company_id)) {
            $supplier->company()->sync($request->input('company_id', []));
        }
        $notification = array(
            'message' => 'Supplier added successfully!',
            'alert-type' => 'success'
        );

        //redirecting to the page with notification message
        return redirect('/outlets/suppliers')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $supplier = Supplier::with(['company'])
            ->select('suppliers.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'suppliers.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'suppliers.created_by', '=', 'employees.id')
            ->where('suppliers.id', $id)
            ->where('suppliers.outlet_id', session('outlet_id'))
            ->firstOrFail();

        return view('pages.supplier.view_supplier', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $supplier = Supplier::where('id', $id)
            ->where('outlet_id', session('outlet_id'))
            ->firstOrFail();

        $companies = Company::where('outlet_id', session('outlet_id'))->pluck('company_title', 'id');
        $supplier->load('company');
        return view('pages.supplier.edit_supplier', compact('supplier', 'companies'));
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
            abort_if(Gate::denies('supplier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //changing data of specific id
        $supplier = Supplier::where('id', $id)
            ->where('outlet_id', session('outlet_id'))
            ->firstOrFail();

        //setting image to ''
        $image_name = "";

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'supplier_title' => 'required',
                'company_id' => 'required',
                'supplier_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'supplier_title.required' => 'Supplier title is required.',
                'company_id.required' => 'Please select a company.'
            ]
        );

        //checking if image has selected 
        if ($request->hasFile('supplier_feature_img')) {


            //deleting the previous Image
            Storage::disk('public')->delete('suppliers/' . $supplier->supplier_feature_img);

            //getting the image name
            $image_full_name = $request->supplier_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->supplier_feature_img->storeAs('suppliers', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $supplier->supplier_feature_img;
        }

        //updating values in database

        $supplier->supplier_title = $request->get('supplier_title');
        $supplier->supplier_address = $request->get('supplier_address');
        $supplier->supplier_cnic = $request->get('supplier_cnic');
        $supplier->supplier_email = $request->get('supplier_email');
        $supplier->supplier_phone = $request->get('supplier_phone');
        $supplier->supplier_description = $request->get('supplier_description');
        $supplier->supplier_feature_img = $image_name;
        $supplier->outlet_id = $request->get('outlet_id');
        $supplier->created_by = $request->get('created_by');



        $supplier->company()->sync($request->input('company_id', []));

        $notification = array(
            'message' => 'Changes saved successfully!',
            'alert-type' => 'success'
        );


        //setting up success message
        if ($supplier->save()) {
            $notification = array(
                'message' => 'Changes saved!',
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
        return redirect('/outlets/suppliers')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('supplier_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //selecting the specific id row for deleting from db
        $supplier = Supplier::where('id', $id)
            ->where('outlet_id', session('outlet_id'))
            ->firstOrFail();

        // if (
        //     count($supplier->company) > 0 || count($supplier->supplier_accounts) > 0 ||
        //     count($supplier->purchase_orders) > 0
        // ) {
        //     $notification = array(
        //         'message' => 'Supplier is already in use!',
        //         'alert-type' => 'error'
        //     );
        //     return redirect('/outlets/suppliers')->with($notification);
        // }
        // $supplier_company = SupplierCompany::where('supplier_id', $id);

        //deleting the image from the storage
        if ($supplier->supplier_feature_img != 'placeholder.jpg') {
            Storage::disk('public')->delete('suppliers/' . $supplier->supplier_feature_img);
        }

        DB::transaction(function () use ($id, $supplier) {
            if ($supplier->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'suppliers',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });


        //setting up succes message
        // if ($supplier->delete() || $supplier_company->delete()) {
        //     $notification = array(
        //         'message' => 'Supplier Deleted!',
        //         'alert-type' => 'success'
        //     );
        // }
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Supplier Deleted!',
                'alert-type' => 'success'
            );
        }
        //setting up succes message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('/outlets/suppliers')->with($notification);
    }


    /**
     * Add Supplier Realtime
     *
     * @param  Request $request
     * @return json
     */
    public function add_supplier_ajax(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if ($request->ajax()) {
            $request->validate([
                'supplier_title' => 'required|min:3',
                'company_id' => 'required',
                'outlet_id' => 'required',
                'created_by' => 'required',
            ]);
            $supplier = Supplier::create(
                [
                    'supplier_title' => $request->supplier_title,
                    'supplier_feature_img' => 'placeholder.jpg',
                    'created_by' => $request->created_by,
                    'outlet_id' => $request->outlet_id,
                ]
            );
            $supplier->company()->sync($request->input('company_id', []));
            return response()->json($supplier->id);
        }
    }

    public function search_supplier(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if ($request->ajax()) {
            if ($request->supplier_public_key) {
                $supplier_outlet = Outlet::with('companies')->where('is_supplier', 1)
                    ->where('public_key', $request->supplier_public_key)
                    ->where('outlet_phone', $request->supplier_phone)
                    ->select('id', 'outlet_title', 'outlet_phone', 'outlet_feature_img')
                    ->first();

                if (!$supplier_outlet)
                    return response('Invalid Credentials', 404);
                else {
                    return response()->json($supplier_outlet);
                }
            }
            // else {
            //     // $request->validate([
            //     //     'supplier_title' => 'required|min:3',
            //     //     'company_id' => 'required',
            //     //     'outlet_id' => 'required',
            //     //     'created_by' => 'required',
            //     // ]);
            //     // $supplier = Supplier::create(
            //     //     [
            //     //         'supplier_title' => $request->supplier_title,
            //     //         'supplier_feature_img' => 'placeholder.jpg',
            //     //         'created_by' => $request->created_by,
            //     //         'outlet_id' => $request->outlet_id,
            //     //     ]
            //     // );
            //     // $supplier->company()->sync($request->input('company_id', []));
            //     // return response()->json($supplier->id);
            // }
        }
    }

    /**
     * Add Supplier Realtime
     *
     * @param  Request $request
     * @return json
     */
    public function add_products_supplier(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate([
            'supplier_title' => 'required|min:3',
            'outlet_id' => 'required',
            'created_by' => 'required',
        ]);
        $supplier = Supplier::create(
            [
                'supplier_title' => $request->supplier_title,
                'supplier_feature_img' => 'placeholder.jpg',
                'created_by' => $request->created_by,
                'outlet_id' => $request->outlet_id,
            ]
        );
        return response()->json($supplier->id);
    }


    /**
     * Get newly added supplier
     *
     * @param  Request $request
     * @return json
     */
    public function get_supplier(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('supplier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $supplier = Supplier::where('id', $request->id)->where('outlet_id', session('outlet_id'))->latest()->pluck('supplier_title', 'id');
        return response()->json($supplier);
    }

    public function get_product(Request $request)
    {
        $supplier = Supplier::with(['company'])->where('id', $request->supplier_id)->first();

        $companies = $supplier->company()->pluck('companies.id');
        $products = Product::whereIn('products.company_id', $companies)
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->select('products.id', 'products.product_title', 'product_stocks.units_in_stock', 'product_stocks.minimum_threshold')
            ->orderBy('product_stocks.units_in_stock', 'asc')
            ->get();

        return response()->json($products);
    }

    public function get_product_supplier(Request $request)
    {
        // return $request->product_id;
        $products = Product::where('id', $request->product_id)
            ->where('outlet_id', session('outlet_id'))
            ->select('products.id', 'products.company_id')
            ->first();

        $company = Company::with(['supplier'])->where('id', $products->company_id)->where('outlet_id', session('outlet_id'))->get();


        return $company;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function file_import(Request $request)
    {
        // dd($request->file('file')->store('temp'));
        Excel::import(new SupplierImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function get_supplier_companies(Request $request)
    {
        if ($request->ajax()) {
            $companies = DB::table('supplier_companies')
                ->leftJoin('companies', 'supplier_companies.company_id', 'companies.id')
                ->where('supplier_companies.supplier_id', $request->supplier_id)
                ->select('companies.company_title')
                ->get();
            return $companies;
        }
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function get_not_supplier_companies(Request $request)
    {
        if ($request->ajax()) {

            $companies = Company::where('companies.outlet_id', session('outlet_id'))
                ->select('companies.id', 'companies.company_title')
                ->get();

            $assigned_companies = SupplierCompany::leftJoin('companies', 'supplier_companies.company_id', 'companies.id')
                ->where('companies.outlet_id', session('outlet_id'))
                ->where('supplier_companies.supplier_id', '=', $request->supplier_id)
                ->select('companies.id', 'companies.company_title')
                ->get();

            return $companies->diff($assigned_companies);
        }
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function assign_company_create()
    {
        $suppliers = Supplier::where('outlet_id', session('outlet_id'))->select('id', 'supplier_title')->get();
        $companies = Company::where('outlet_id', session('outlet_id'))->select('id', 'company_title')->get();

        return view('pages.supplier.assign-company', compact('suppliers', 'companies'));
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function assign_company_store(Request $request)
    {
        $request->validate(
            [
                'supplier_id' => 'required',
                'company_id' => 'required'
            ],
            [
                'supplier_id.required' => 'Please select supplier',
                'company_id.required' => 'Please select company',
            ]
        );
        $supplier_company = SupplierCompany::create([
            'supplier_id' => $request->supplier_id,
            'company_id' => $request->company_id,
        ]);

        if ($request->ajax()) {
            return $supplier_company->supplier_id;
        }
        return redirect()->back();
    }
}
