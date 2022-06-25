<?php

namespace App\Http\Controllers;

use App\Imports\CompanyImport;
use Illuminate\Http\Request;
use App\Models\Company;
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

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $companies = DB::table('companies')
            ->select('companies.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'companies.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'companies.created_by', '=', 'employees.id')
            ->where('companies.outlet_id', session('outlet_id'))
            ->latest()
            ->get();

        return view('pages.company.companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('pages.company.add_company');
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
            abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'company_title' => [
                    'required', Rule::unique('companies')->where(function ($query) {
                        $query->where('outlet_id', session('outlet_id'));
                    })
                ],
                'company_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'company_title.required' => 'Company title is required.'
            ]
        );

        if ($request->hasFile('company_feature_img')) {
            //getting the image name
            $image_full_name = $request->company_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->company_feature_img->storeAs('companies', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }

        //adding data to products
        $company = new Company(
            [
                'company_title' => $request->get('company_title'),
                'company_address' => $request->get('company_address'),
                'company_email' => $request->get('company_email'),
                'company_phone' => $request->get('company_phone'),
                'company_description' => $request->get('company_description'),
                'company_feature_img' => $image_name,
                'outlet_id' => $request->get('outlet_id'),
                'created_by' => $request->get('created_by')
            ]
        );

        //setting up success message
        if ($company->save()) {
            $notification = array(
                'message' => 'Company added successfully!',
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
        return redirect('/outlets/companies')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $company = Company::select('companies.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'companies.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'companies.created_by', '=', 'employees.id')
            ->where('companies.outlet_id', session('outlet_id'))
            ->where('companies.id', $id)
            ->firstOrFail();

        $total_products = Product::where('company_id', $company->id)->count();


        return view('pages.company.view_company', compact('company', 'total_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $company = Company::where('companies.outlet_id', session('outlet_id'))
            ->where('companies.id', $id)
            ->firstOrFail();
        return view('pages.company.edit_company', compact('company'));
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
            abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //changing data of specific id
        $company = Company::where('companies.outlet_id', session('outlet_id'))
            ->where('companies.id', $id)
            ->firstOrFail();

        //setting image to ''
        $image_name = "";


        $request->validate(
            [
                'company_title' => 'required',
                'company_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'company_title.required' => 'Company title is required.'
            ]
        );

        //checking if image has selected 
        if ($request->hasFile('company_feature_img')) {


            //deleting the previous Image
            Storage::disk('public')->delete('companies/' . $company->company_feature_img);

            //getting the image name
            $image_full_name = $request->company_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->company_feature_img->storeAs('companies', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $company->company_feature_img;
        }

        //updating values in database

        $company->company_title = $request->get('company_title');
        $company->company_address = $request->get('company_address');
        $company->company_email = $request->get('company_email');
        $company->company_phone = $request->get('company_phone');
        $company->company_description = $request->get('company_description');
        $company->company_feature_img = $image_name;
        $company->outlet_id = $request->get('outlet_id');
        $company->created_by = $request->get('created_by');

        if ($company->save()) {
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
        return redirect('/outlets/companies')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('company_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //selecting the specific id row for deleting from db
        $company = Company::where('companies.outlet_id', session('outlet_id'))
            ->where('companies.id', $id)
            ->firstOrFail();

        if (count($company->product) > 0 || count($company->product) > 0) {
            $notification = array(
                'message' => 'Company is already in use!',
                'alert-type' => 'error'
            );
            return redirect('/outlets/companies')->with($notification);
        }

        //deleting the image from the storage
        Storage::disk('public')->delete('companies/' . $company->company_feature_img);


        DB::transaction(function () use ($id, $company) {
            if ($company->delete()) {
                DataSync::create([
                    'record_id' => $id,
                    'table_name' => 'companies',
                    'action' => 'delete',
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });

        //setting up succes message
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Company Deleted!',
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
        return redirect('/outlets/companies')->with($notification);
    }


    /**
     * Add company realtime
     *
     * @param  Request $request
     * @return json
     */
    public function add_company_ajax(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate([
            'company_title' => [
                'required', Rule::unique('companies')->where(function ($query) {
                    $query->where('outlet_id', session('outlet_id'));
                })
            ],
        ]);

        $company = Company::create(
            [
                'company_title' => $request->company_title,
                'company_feature_img' => 'placeholder.jpg',
                'created_by' => session('employee_id'),
                'outlet_id' => session('outlet_id'),
            ]
        );
        // $company->save();

        $company->supplier()->sync($request->input('supplier_id', []));
        return response()->json($company->id);
    }


    /**
     * Get newly added company
     *
     * @param  Request $request
     * @return json
     */
    public function get_company(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $company = Company::where('id', $request->id)->where('outlet_id', session('outlet_id'))->pluck('company_title', 'id');
        return response()->json($company);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function file_import(Request $request)
    {
        // dd($request->file);
        Excel::import(new CompanyImport, $request->file('file')->store('temp'));
        return back();
    }


    public function get_standard_company()
    {
        $outlet_city = Outlet::where('id', session('outlet_id'))->pluck('outlet_country')->first();
        $standard_companies = DB::table('standard_companies')->where('country_id', $outlet_city)->get();
        return view('pages.company.import_standard_companies', compact('standard_companies'));
    }
    public function store_standard_company(Request $request)
    {
        DB::transaction(function () use ($request) {
            $standard_companies = DB::table('standard_companies')->whereIn('id', $request->company_id)->get();
            foreach ($standard_companies as $standard_company) {
                $company = Company::firstOrNew(
                    [
                        'company_title' => $standard_company->title,
                        'outlet_id' => session('outlet_id')
                    ],
                    [
                        'company_title' => $standard_company->title,
                        'company_address' => $standard_company->address,
                        'company_email' => $standard_company->email,
                        'company_phone' => $standard_company->phone,
                        'company_description' => $standard_company->description,
                        'company_feature_img' => $standard_company->featured_img,
                        'outlet_id' => session('outlet_id'),
                        'created_by' => session('employee_id'),
                    ]
                );
                $company->save();
            }
        });
        if (DB::transactionLevel() == 0) {
            $notification = array(
                'message' => 'Companies Imported',
                'alert-type' => 'success'
            );
            //setting up succes message
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('companies.index')->with($notification);
    }
}
