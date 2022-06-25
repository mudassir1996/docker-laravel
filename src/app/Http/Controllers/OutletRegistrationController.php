<?php

namespace App\Http\Controllers;

use App\Models\OutletRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class OutletRegistrationController extends Controller
{
    // public function __construct()
    // {
    //     abort_if(Gate::denies('outlets_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $reg_detail = OutletRegistration::where('outlet_id', session('outlet_id'))->first();
        return view('pages.outlet.registration', compact('reg_detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('outlet_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('pages.outlet.add_registration');
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
            abort_if(Gate::denies('outlet_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate([
            'registered_name' => 'required',
            'registered_address' => 'required',
            'registration_date' => 'required|date',
        ]);

        $reg_detail = new OutletRegistration($request->all());

        //setting up success message
        if ($reg_detail->save()) {
            $notification = array(
                'message' => 'Outlet added successfully!',
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
        return back()->with($notification);
    }
}
