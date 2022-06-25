<?php

namespace App\Http\Controllers\Airlines;

use App\Http\Controllers\Controller;
use App\Models\Airlines\AirlineTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AirlineTicketController extends Controller
{
    public function index()
    {
        // $airline_tickets = AirlineTicket::leftJoin('airline_orders', 'airline_orders.id', 'airline_tickets.airline_order_id')
        //     ->where('airline_orders.outlet_id', session('outlet_id'))
        //     ->select('airline_tickets.*', 'airline_orders.created_at', 'airline_orders.updated_at')
        //     ->get();

        return view('pages.airlines.tickets.index');
        // dd($airline_tickets);
    }
    public function ticketsJson()
    {
        if (request()->ajax()) {
            $airline_orders = AirlineTicket::search()->leftJoin('airline_orders', 'airline_orders.id', 'airline_tickets.airline_order_id')
                ->where('airline_orders.outlet_id', session('outlet_id'))
                ->select('airline_tickets.*', 'airline_orders.created_at', 'airline_orders.updated_at')
                ->orderBy('airline_tickets.id', 'desc')
                ->get();

            return DataTables::of($airline_orders)
                ->make(true);
        }
    }
}
