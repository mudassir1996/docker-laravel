<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'airline_order_id',
        'pax_title',
        'pax_name',
        'ticket_class',
        'flight_type',
        'ticket_number',
        'flight_number',
        'departure_date',
        'sector',
        'route',
        'pnr',
        'gds_pnr',
        'remarks',
        'base_price',
        'airline_discount_value',
        'total_ticket_value',
        'total_tax_value',
        'service_charges_value',
        'total_amount'
    ];
    protected $casts = [
        'departure_date' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function ticket_tax_details()
    {
        return $this->hasMany(TicketTaxDetail::class, 'airline_ticket_id');
    }

    public function scopeSearch($query)
    {
        if (!empty(request()->orderId)) {
            $query->where('airline_tickets.airline_order_id', request()->orderId);
        }
        if (!empty(request()->ticketNumber)) {
            $query->where('airline_tickets.ticket_number', request()->ticketNumber);
        }
        if (!empty(request()->paxName)) {
            $query->where('airline_tickets.pax_name', request()->paxName);
        }
        if (!empty(request()->flightNumber)) {
            $query->where('airline_tickets.flight_number', 'like', '%' . request()->flightNumber . '%');
        }
        if (!empty(request()->depDate)) {
            $date = explode('-', request()->depDate);
            $fromDate = date('Y-m-d', strtotime($date[0]));
            $toDate = date('Y-m-d', strtotime($date[1]));
            $query->whereDate('airline_tickets.departure_date', '>=', $fromDate);
            $query->whereDate('airline_tickets.departure_date', '<=', $toDate);
        }
    }
}
