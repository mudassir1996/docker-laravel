<?php

namespace App\Models\Cashbook;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbook extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "remarks",
        "amount",
        "supplier_id",
        "customer_id",
        "transaction_type",
        "payment_category_id",
        "payment_date",
        "payment_type_id",
        "payment_method_id",
        "outlet_id",
        "created_by"
    ];


    public function scopeFilter($filter)
    {
        if (request()->date_range != '') {
            $date = explode('-', request()->date_range);
            $fromDate = date('Y-m-d', strtotime($date[0]));
            $toDate = date('Y-m-d', strtotime($date[1]));

            $filter->whereDate('payment_date', '>=', $fromDate);
            $filter->whereDate('payment_date', '<=', $toDate);
        }
        // else if(request()->date){

        // }
        else {
            $filter->whereDate('created_at', Carbon::today());
        }
        return $filter;
    }
}
