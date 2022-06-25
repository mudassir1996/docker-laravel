<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


class TicketController extends Controller
{
    // public function __construct()
    // {
    //     abort_if(Gate::denies('ticket_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        abort_if(Gate::denies('ticket_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $tickets = Ticket::select('tickets.*', 'employees.employee_name')
            ->leftJoin('employees', 'tickets.created_by', '=', 'employees.id')
            ->where('tickets.outlet_id', session('outlet_id'))
            ->latest()
            ->get();
        return view('pages.tickets.ticket_list', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('ticket_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('pages.tickets.add_ticket');
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
            abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        //validating image (filetypes:jpg,png, maxsize:2MB)
        $request->validate(
            [
                'title' => 'required',
                'status' => 'required',
                'featured_img' => 'mimes:jpg,png|max:2048'
            ],
            [
                'title.required' => 'Title is required.',
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
            $image_path .= $request->featured_img->storeAs('tickets', $image_name, 'public');
        } else {
            $image_path = 'placeholder.jpg';
        }


        $ticket = new Ticket(
            [
                'title' => $request->title,
                'status' => $request->status,
                'description' => $request->description,
                'featured_img' => $image_path,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by,
            ]
        );


        //setting up success message
        if ($ticket->save()) {
            $notification = array(
                'message' => 'Ticket added successfully!',
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

        return redirect('outlets/tickets')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        abort_if(Gate::denies('ticket_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('ticket_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $ticket = Ticket::with('ticket_response')->where('tickets.id', $id)
            ->where('tickets.created_by', session('employee_id'))
            ->where('tickets.outlet_id', session('outlet_id'))
            ->rightJoin('employees', 'employees.id', 'tickets.created_by')
            ->select('tickets.*', 'employees.employee_name', 'employees.employee_feature_img')
            ->firstOrFail();
        return view('pages.tickets.ticket_response', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function add_ticket_ajax(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate([
            'title' => 'required|min:3',
            'outlet_id' => 'required',
            'created_by' => 'required',
        ]);
        $ticket = Ticket::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'open',
                'feature_img' => 'placeholder.jpg',
                'created_by' => $request->created_by,
                'outlet_id' => $request->outlet_id,
            ]
        );
        // $supplier->company()->sync($request->input('company_id', []));
        return response()->json(['success' => 'Ticket added successfully!']);
    }
}
