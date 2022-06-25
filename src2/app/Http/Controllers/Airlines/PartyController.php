<?php

namespace App\Http\Controllers\Airlines;

use App\Classes\PhoneFormatter;
use App\Http\Controllers\Controller;
use App\Models\Airlines\Party;
use App\Models\Airlines\PartyAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::where('parties.outlet_id', session('outlet_id'))
            ->leftJoin('employees', 'employees.id', 'parties.created_by')
            ->select('parties.*', 'employees.employee_name')
            ->get();
        return view('pages.airlines.parties.index', compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.airlines.parties.add-party');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'party_title' => 'required',
                'party_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'party_title.required' => 'Title is required.',
            ]
        );
        $phone = '';
        if ($request->party_phone != '') {
            $formatted_phone = PhoneFormatter::format_number($request->party_phone);

            $phone = new Request([
                'party_phone' => $formatted_phone
            ]);
            $this->validate(
                $phone,
                [
                    'party_phone' => 'regex:/(92)[0-9]{10}/',
                ],
                [
                    'party_phone.regex' => 'Phone number is invalid.',
                ]
            );
        }


        if ($request->hasFile('party_feature_img')) {
            //getting the image name
            $image_full_name = $request->party_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->party_feature_img->storeAs('parties', $image_name, 'public');
        } else {
            $image_name = 'placeholder.jpg';
        }


        //adding data to products
        $party = new Party(
            [
                'party_title' => $request->get('party_title'),
                'party_phone' => $phone->party_phone ?? '',
                'party_regno' => $request->get('party_regno'),
                'party_email' => $request->get('party_email'),
                'party_address' => $request->get('party_address'),
                'allow_credit' => $request->get('allow_credit') ?? 0,
                'party_description' => $request->get('party_description'),
                'party_feature_img' => $image_name,
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id')
            ]
        );



        // //setting up success message
        if ($party->save()) {
            $notification = array(
                'message' => 'Party added successfully!',
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

        return redirect()->route('parties.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party = Party::where('parties.outlet_id', session('outlet_id'))
            ->where('parties.id', $id)
            ->leftJoin('employees', 'employees.id', 'parties.created_by')
            ->select('parties.*', 'employees.employee_name')
            ->firstOrFail();

        $balance = PartyAccount::where('party_id', $party->id)->select('balance')->latest()->first();
        $balance = $balance->balance ?? 0.00;
        // dd($balance);

        return view('pages.airlines.parties.view-party', compact('party', 'balance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $party = Party::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();
        return view('pages.airlines.parties.edit-party', compact('party'));
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

        $request->validate(
            [
                'party_title' => 'required',
                'party_feature_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'party_title.required' => 'Title is required.',
            ]
        );
        $phone = '';
        if ($request->party_phone != '') {
            $formatted_phone = PhoneFormatter::format_number($request->party_phone);

            $phone = new Request([
                'party_phone' => $formatted_phone
            ]);
            $this->validate(
                $phone,
                [
                    'party_phone' => 'regex:/(92)[0-9]{10}/',
                ],
                [
                    'party_phone.regex' => 'Phone number is invalid.',
                ]
            );
        }

        $party = Party::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        //checking if image has selected 
        if ($request->hasFile('party_feature_img')) {

            //deleting the previous Image
            Storage::disk('public')->delete('parties/' . $party->party_feature_img);

            //getting the image name
            $image_full_name = $request->party_feature_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $request->party_feature_img->storeAs('parties', $image_name, 'public');
        } else {

            //if image has not changed then uploading same image name to data base
            $image_name = $party->party_feature_img;
        }

        $updated = $party->update(
            [
                'party_title' => $request->get('party_title'),
                'party_phone' => $phone->party_phone ?? '',
                'party_regno' => $request->get('party_regno'),
                'party_email' => $request->get('party_email'),
                'party_address' => $request->get('party_address'),
                'allow_credit' => $request->get('allow_credit') ?? 0,
                'party_description' => $request->get('party_description'),
                'party_feature_img' => $image_name,
                'outlet_id' => session('outlet_id'),
                'created_by' => session('employee_id')
            ]
        );

        // //setting up success message
        if ($updated) {
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

        return redirect()->route('parties.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::where('outlet_id', session('outlet_id'))
            ->where('id', $id)
            ->firstOrFail();

        //deleting the image from the storage
        Storage::disk('public')->delete('parties/' . $party->customer_feature_img);
        // CustomerAccount::where('customer_id', $id)->get();
        if ($party->delete()) {
            //setting up success message
            $notification = array(
                'message' => 'Party Deleted',
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
        return redirect()->route('parties.index')->with($notification);
    }

    /**
     * Add party realtime
     *
     * @param  Request $request
     * @return json
     */
    public function add_party_ajax(Request $request)
    {
        $request->validate(
            [
                'party_title' => 'required',
            ],
            [
                'party_title.required' => 'Title is required.',
            ]
        );

        $party = Party::create(
            [
                'party_title' => $request->party_title,
                'party_phone' => $request->party_phone,
                'party_feature_img' => 'placeholder.jpg',
                'created_by' => session('employee_id'),
                'outlet_id' => session('outlet_id'),
            ]
        );

        return response()->json($party->id);
    }

    /**
     * Get newly added party
     *
     * @param  Request $request
     * @return json
     */
    public function get_party(Request $request)
    {
        $party = Party::where('outlet_id', session('outlet_id'))->pluck('party_title', 'id');
        return response()->json($party);
    }
}
