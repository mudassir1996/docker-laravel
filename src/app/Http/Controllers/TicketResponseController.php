<?php

namespace App\Http\Controllers;

use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class TicketResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('ticket_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('ticket_response_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'response' => 'required',
                'status' => 'required',
                'featured_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'response.required' => 'Please fill out the field.',
                'status.required' => 'Please select a status.',
                'featured_img.mimes' => 'Please select a valid image.',
            ]
        );


        if ($request->hasFile('featured_img')) {
            //getting the image name
            $image_full_name = $request->featured_img->getClientOriginalName();
            $image_name_arr = explode('.', $image_full_name);
            $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

            //storing image at public/storage/products/$image_name
            $image_path = URL::to('/') . '/storage' . '/';
            $image_path .= $request->featured_img->storeAs('ticket_response', $image_name, 'public');
        } else {
            $image_path = 'placeholder.jpg';
        }


        $ticket_response = new TicketResponse(
            [
                'ticket_id' => $request->ticket_id,
                'response' => $request->response,
                'status' => $request->status,
                'featured_img' => $image_path,
                'created_by' => $request->created_by,
            ]
        );




        //setting up success message
        if ($ticket_response->save()) {
            $notification = array(
                'message' => 'Ticket Response added successfully!',
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

        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return \Illuminate\Http\Response
     */
    public function show(TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketResponse $ticketResponse)
    {
        //
    }
}
