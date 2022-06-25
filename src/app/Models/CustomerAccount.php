<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    protected $fillable = [
        'amount',
        'balance',
        'payment_type',
        'description',
        'payment_date',
        'payment_method_id',
        'order_id',
        'customer_id',
        'outlet_id',
        'created_by'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeFilter($filter)
    {
        if (request()->date_range != '') {
            $date = explode('-', request()->date_range);
            $fromDate = date('Y-m-d', strtotime($date[0]));
            $toDate = date('Y-m-d', strtotime($date[1]));

            $filter->whereDate('customer_accounts.payment_date', '>=', $fromDate);
            $filter->whereDate('customer_accounts.payment_date', '<=', $toDate);
        }
        $filter->where('customer_accounts.customer_id', request()->customer_id);

        return $filter;
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('customer_accounts.updated_at', '>=', $last_backup_date);
        }
    }
}
