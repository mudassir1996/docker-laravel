<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_party_id',
        'category_id',
        'supplier_party_id',
        'total_recievable',
        'airline_payable',
        'other_payable',
        'total_payable',
        'total_income',
        'tax_value',
        'discount_value',
        'comission_value',
        'amount_payable',
        'amount_paid',
        'change_back',
        'status',
        'payment_type_id',
        'payment_method_id',
        'remarks',
        'order_completion_date',
        'processing_person_id',
        'outlet_id',
        'created_by',
    ];
    protected $casts = [
        'order_completion_date' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function airline_tickets()
    {
        return $this->hasMany(AirlineTicket::class);
    }
    public function discount_details()
    {
        return $this->hasMany(DiscountDetail::class);
    }
    public function commission_details()
    {
        return $this->hasMany(CommissionDetail::class);
    }

    public function scopeSearch($query)
    {
        if (!empty(request()->orderId)) {
            $query->where('airline_orders.id', request()->orderId);
        }
        if (!empty(request()->ticketNumber)) {
            $query->whereHas('airline_tickets', function ($q) {
                $q->where('ticket_number', request()->ticketNumber);
            });
        }
        if (!empty(request()->customerId)) {
            $query->where('airline_orders.customer_party_id', request()->customerId);
        }
        if (!empty(request()->supplierId)) {
            $query->where('airline_orders.supplier_party_id', request()->supplierId);
        }
        if (!empty(request()->payment_type_id)) {
            $query->where('airline_orders.payment_type_id', request()->payment_type_id);
        }
        if (!empty(request()->category_id)) {
            $query->where('airline_orders.category_id', request()->category_id);
        }
    }
}
