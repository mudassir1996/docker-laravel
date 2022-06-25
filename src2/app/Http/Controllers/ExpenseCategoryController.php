<?php

namespace App\Http\Controllers;

use App\Imports\ExpenseCategoryImport;
use App\Models\DataSync;
use App\Models\ExpenseCategory;
use App\Models\ExpenseTransaction;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('expense_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $expense_categories = DB::table('expense_categories')
            ->select('expense_categories.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_categories.created_by', '=', 'employees.id')
            ->where('expense_categories.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        return view('pages.expenses.expense_category.expense_category', compact('expense_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('expense_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('pages.expenses.expense_category.add_expense_category');
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
            abort_if(Gate::denies('expense_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'title' => [
                    'required', Rule::unique('expense_categories')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ],
                'feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'title.required' => 'Title is required.'
            ]
        );

        if ($request->hasFile('feature_img')) {
            //getting the image name
            $image_full_name = $request->feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->feature_img->storeAs('expense/expense-category', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }

        //adding data to products
        $expense_category = new ExpenseCategory(
            [
                'title' => $request->title,
                'description' => $request->description,
                'feature_img' => $image_name,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by
            ]
        );

        //setting up success message
        if ($expense_category->save()) {
            $notification = array(
                'message' => 'Expense Category added successfully!',
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
        return redirect()->route('expense-category.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $expense_category = ExpenseCategory::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        return view('pages.expenses.expense_category.edit_expense_category', compact('expense_category'));
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
            abort_if(Gate::denies('expense_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //changing data of specific id
        $expense_category = ExpenseCategory::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        //setting image to ''
        $image_name = "";


        $request->validate(
            [

                'title' => [
                    'required', Rule::unique('expense_categories')->where(function ($query) use ($id) {
                        $query->where('outlet_id', session('outlet_id'))
                            ->where('id', '!=', $id);
                    })
                ],
                'feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'title.required' => 'Title is required.'
            ]
        );

        //checking if image has selected 
        if ($request->hasFile('feature_img')) {

            //deleting the previous Image
            Storage::disk('public')->delete('expense/expense-category/' . $expense_category->feature_img);

            //getting the image name
            $image_full_name = $request->feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->feature_img->storeAs('expense/expense-category', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $expense_category->feature_img;
        }

        //updating values in database

        $expense_category->title = $request->title;
        $expense_category->description = $request->description;
        $expense_category->feature_img = $image_name;
        $expense_category->outlet_id = $request->outlet_id;
        $expense_category->created_by = $request->created_by;

        if ($expense_category->save()) {
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
        return redirect()->route('expense-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //selecting the specific id row for deleting from db
        $expense_category = ExpenseCategory::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        if (count($expense_category->expense_transactions) > 0) {
            $notification = array(
                'message' => 'Record is already in use!',
                'alert-type' => 'error'
            );
            return redirect('/outlets/expense-category')->with($notification);
        }

        Storage::disk('public')->delete('expense/expense-category/' . $expense_category->feature_img);
        DB::transaction(function () use ($id, $expense_category) {
            if ($expense_category->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'expense_categories',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });

        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Expense Category Deleted!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Please delete all transactions first',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect()->route('expense-category.index')->with($notification);
    }


    public function add_expense_category_ajax(Request $request)
    {
        // abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate([
            'title' => [
                'required', Rule::unique('expense_categories')->where(function ($query) {
                    $query->where('outlet_id', session('outlet_id'));
                })
            ],
        ]);
        $expense_category = ExpenseCategory::create(
            [
                'title' => $request->title,
                'feature_img' => 'placeholder.jpg',
                'created_by' => $request->created_by,
                'outlet_id' => $request->outlet_id,
            ]
        );
        return response()->json($expense_category->id);
    }

    public function get_expense_category(Request $request)
    {
        // abort_if(Gate::denies('customer_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $expense_category = ExpenseCategory::where('id', $request->id)->where('outlet_id', session('outlet_id'))->pluck('title', 'id');
        return response()->json($expense_category);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function file_import(Request $request)
    {
        // dd($request->file('file')->store('temp'));
        Excel::import(new ExpenseCategoryImport, $request->file('file')->store('temp'));
        return back();
    }

    public function get_standard_expense_category()
    {
        $outlet_business = Outlet::where('id', session('outlet_id'))->pluck('business_type_id')->first();
        $standard_expense_categories = DB::table('standard_expense_categories')->where('business_type_id', $outlet_business)->get();
        return view('pages.expenses.expense_category.import_standard_expense_categories', compact('standard_expense_categories'));
    }
    public function store_standard_expense_category(Request $request)
    {
        DB::transaction(function () use ($request) {
            $standard_expense_categories = DB::table('standard_expense_categories')->whereIn('id', $request->category_id)->get();
            foreach ($standard_expense_categories as $standard_expense_category) {
                $expense_category = ExpenseCategory::firstOrCreate(
                    [
                        'title' => $standard_expense_category->title,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'title' => $standard_expense_category->title,
                        'description' => $standard_expense_category->description,
                        'feature_img' => $standard_expense_category->featured_img,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
            }
        });
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Expense Categories Imported',
                'alert-type' => 'success'
            );
            //setting up succes message
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('expense-category.index')->with($notification);
    }
}
