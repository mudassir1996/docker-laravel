<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DataSync;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('category_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //selecting all rows from categories
        // $categories = Category::where('outlet_id', session('outlet_id'))->get();
        $categories = DB::table('categories')
            ->select('categories.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'categories.created_by', '=', 'employees.id')
            ->where('categories.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        //passing data to the view
        // return view('pages.product.products', compact('categories', 'top_products'));
        return view('pages.category.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('category_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //loading add category view
        return view('pages.category.add_category');
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
            abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate(
            [
                'category_title' => [
                    'required', Rule::unique('categories')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ],
                'category_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'category_title.required' => 'Category title is required.'
            ]
        );

        if ($request->hasFile('category_feature_img')) {
            //getting the image name
            $image_full_name = $request->category_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->category_feature_img->storeAs('categories', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }

        //adding data to products
        $category = new Category(
            [
                'category_title' => $request->get('category_title'),
                'category_description' => $request->get('category_description'),
                'category_feature_img' => $image_name,
                'outlet_id' => $request->get('outlet_id'),
                'created_by' => $request->get('created_by')
            ]
        );

        //setting up success message
        if ($category->save()) {
            $notification = array(
                'message' => 'Category added successfully!',
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
        return redirect('/outlets/categories')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('category_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $category = Category::select('categories.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'categories.created_by', '=', 'employees.id')
            ->where('categories.outlet_id', session('outlet_id'))
            ->where('categories.id', $id)
            ->firstOrFail();

        $total_products = Product::where('category_id', $category->id)->count();

        // dd($category);
        return view('pages.category.view_category', compact('category', 'total_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('category_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $category = Category::where('categories.outlet_id', session('outlet_id'))
            ->where('categories.id', $id)
            ->firstOrFail();
        return view('pages.category.edit_category', compact('category'));
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
            abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //changing data of specific id
        $category = Category::where('categories.outlet_id', session('outlet_id'))
            ->where('categories.id', $id)
            ->firstOrFail();

        //setting image to ''
        $image_name = "";

        $request->validate(
            [
                'category_title' => [
                    'required', Rule::unique('categories')->where(function ($query) use ($id) {
                        $query->where('outlet_id', session('outlet_id'))
                            ->where('id', '!=', $id);
                    })
                ],
                'category_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'category_title.required' => 'Category title is required.'
            ]
        );

        //checking if image has selected 
        if ($request->hasFile('category_feature_img')) {

            //deleting the previous Image
            Storage::disk('public')->delete('categories/' . $category->category_feature_img);

            //getting the image name
            $image_full_name = $request->category_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->category_feature_img->storeAs('categories', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $category->category_feature_img;
        }

        //updating values in database
        $category->category_title = $request->get('category_title');
        $category->category_description = $request->get('category_description');
        $category->category_feature_img = $image_name;
        $category->outlet_id = $request->get('outlet_id');
        $category->created_by = $request->get('created_by');

        if ($category->save()) {
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

        // //checking where the request is coming from(manage-products/products)
        // $previous_page = $request->get('previous_page');

        //redirecting to the page with notification message
        return redirect('/outlets/categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('category_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        //selecting the specific id row for deleting from db
        $category = Category::where('categories.outlet_id', session('outlet_id'))
            ->where('categories.id', $id)
            ->firstOrFail();

        if (count($category->product) > 0) {
            $notification = array(
                'message' => 'Category is already in use!',
                'alert-type' => 'error'
            );
            return redirect('/outlets/categories')->with($notification);
        }

        //deleting the image from the storage
        Storage::disk('public')->delete('categories/' . $category->category_feature_img);

        DB::transaction(function () use ($id, $category) {
            if ($category->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'categories',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });

        //setting up succes message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Category Deleted!',
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
        return redirect('/outlets/categories')->with($notification);
    }

    /**
     * Add category realtime
     *
     * @param  Request $request
     * @return json
     */

    public function add_category_ajax(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate([
            'category_title' => [
                'required', Rule::unique('categories')->where(function ($query) use ($request) {
                    $query->where('outlet_id', $request->outlet_id);
                })
            ],
        ]);



        $category = new Category(
            [
                'category_title' => $request->category_title,
                'category_feature_img' => 'placeholder.jpg',
                'created_by' => session('employee_id'),
                'outlet_id' => session('outlet_id'),
            ]
        );

        $category->save();

        return response()->json($category->id);
    }

    /**
     * Get newly added Category
     *
     * @param  Request $request
     * @return json
     */

    public function get_category(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $category = Category::where('id', $request->id)->where('outlet_id', session('outlet_id'))->latest()->pluck('category_title', 'id');
        return response()->json($category);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function file_import(Request $request)
    {
        // dd($request->file);
        Excel::import(new CategoryImport, $request->file('file')->store('temp'));
        return back();
    }

    public function get_standard_category()
    {
        $outlet_business = Outlet::where('id', session('outlet_id'))->pluck('business_type_id')->first();
        $standard_categories = DB::table('standard_categories')->where('business_type_id', $outlet_business)->get();
        return view('pages.category.import_standard_categories', compact('standard_categories'));
    }
    public function store_standard_category(Request $request)
    {
        if ($request->category_id == '') {
            $notification = array(
                'message' => 'Please select atleast 1 record',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        DB::transaction(function () use ($request) {
            $standard_categories = DB::table('standard_categories')->whereIn('id', $request->category_id)->get();
            foreach ($standard_categories as $standard_category) {
                $category = Category::firstOrNew(
                    [
                        'category_title' => $standard_category->title,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'category_title' => $standard_category->title,
                        'category_description' => $standard_category->description,
                        'category_feature_img' => $standard_category->featured_img,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
                $category->save();
            }
        });
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Categories Imported',
                'alert-type' => 'success'
            );
            //setting up succes message
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('categories.index')->with($notification);
    }
}
