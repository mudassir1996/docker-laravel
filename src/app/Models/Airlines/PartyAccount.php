<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'amount',
        'balance',
        'payment_type',
        'payment_method_id',
        'system_remarks',
        'description',
        'payment_date',
        'order_id',
        'outlet_id',
        'created_by'
    ];
    public function scopeFilter($filter)
    {
        if (request()->date_range != '') {
            $date = explode('-', request()->date_range);
            $fromDate = date('Y-m-d', strtotime($date[0]));
            $toDate = date('Y-m-d', strtotime($date[1]));

            $filter->whereDate('party_accounts.payment_date', '>=', $fromDate);
            $filter->whereDate('party_accounts.payment_date', '<=', $toDate);
        }
        $filter->where('party_accounts.party_id', request()->party_id);

        return $filter;
    }
}
