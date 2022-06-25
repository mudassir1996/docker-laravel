<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTaxDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'airline_order_id',
        'airline_ticket_id',
        'title',
        'description',
        'value',
        'percentage',
        'type',
        'outlet_id',
        'created_by',
    ];
}
