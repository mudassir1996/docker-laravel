<?php

namespace App\Http\Controllers\Airlines;

use App\Http\Controllers\Controller;
use App\Models\Airlines\OutletCommission;
use App\Models\Airlines\Party;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_commissions = OutletCommission::where('outlet_commissions.outlet_id', session('outlet_id'))
            ->leftJoin('parties', 'parties.id', 'outlet_commissions.party_id')
            ->leftJoin('employees', 'employees.id', 'outlet_commissions.created_by')
            ->select('outlet_commissions.*', 'employees.employee_name', 'parties.party_title')
            ->get();

        return view('pages.airlines.commissions.index', compact('outlet_commissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parties = Party::where('outlet_id', session('outlet_id'))->select('id', 'party_title')->get();
        return view('pages.airlines.commissions.create', compact('parties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'commission_title' => [
                'required', Rule::unique('outlet_commissions')->where(function ($query) {
                    $query->where('outlet_id', session('outlet_id'));
                })
            ],
            'commission_value' => 'required|integer',
            'commission_type' => 'required',
            'commission_status' => 'required',
            'party_id' => 'required',
        ]);

        $outlet_commission = new OutletCommission([
            'commission_title' => $request->commission_title,
            'commission_value' => $request->commission_value,
            'commission_type' => $request->commission_type,
            'commission_status' => $request->commission_status,
            'party_id' => $request->party_id,
            'commission_description' => $request->commission_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);

        //setting up success message
        if ($outlet_commission->save()) {
            $notification = array(
                'message' => 'Commission added successfully!',
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
        return redirect()->route('outlet-commissions.index')->with($notification);
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
        $parties = Party::where('outlet_id', session('outlet_id'))->select('id', 'party_title')->get();
        $outlet_commission = OutletCommission::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        return view('pages.airlines.commissions.edit', compact('outlet_commission', 'parties'));
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
        $request->validate([
            'commission_title' => [
                'required', Rule::unique('outlet_commissions')->where(function ($query) use ($id) {
                    $query->where('outlet_id', session('outlet_id'))
                        ->where('id', '!=', $id);
                })
            ],
            'commission_value' => 'required|numeric',
            'commission_type' => 'required',
            'commission_status' => 'required',
            'party_id' => 'required',
        ]);

        $outlet_commission = OutletCommission::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        $outlet_commission->update([
            'commission_title' => $request->commission_title,
            'commission_value' => $request->commission_value,
            'commission_type' => $request->commission_type,
            'commission_status' => $request->commission_status,
            'party_id' => $request->party_id,
            'commission_description' => $request->commission_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);

        //setting up success message
        if ($outlet_commission) {
            $notification = array(
                'message' => 'Changes Saved!',
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
        return redirect()->route('outlet-commissions.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet_commission = OutletCommission::where('outlet_id', session('outlet_id'))->where('id', $id)->firstOrFail();
        //setting up success message
        if ($outlet_commission->delete()) {
            $notification = array(
                'message' => 'Commission deleted successfully!',
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
        return redirect()->route('outlet-commissions.index')->with($notification);
    }


    /**
     * Get commission data
     *
     * @param  Request $request
     * @return json
     */
    public function get_commission(Request $request)
    {
        $commission = OutletCommission::where('id', $request->id)->where('outlet_id', session('outlet_id'))->first();
        return response()->json($commission);
    }

    /**
     * POST commission data
     *
     * @param  Request $request
     * @return json
     */
    public function add_commission_ajax(Request $request)
    {
        $outlet_commission = new OutletCommission([
            'commission_title' => $request->commission_title,
            'commission_value' => $request->commission_value,
            'commission_type' => $request->commission_type,
            'commission_status' => $request->commission_status,
            'party_id' => $request->party_id,
            'commission_description' => $request->commission_description,
            'outlet_id' => session('outlet_id'),
            'created_by' => session('employee_id'),
        ]);
        $outlet_commission->save();
        return response()->json($outlet_commission->id);
    }
}
