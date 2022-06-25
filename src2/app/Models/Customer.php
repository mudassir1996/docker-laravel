<?php

namespace App\Models;

use App\Models\Sales\SalesOrder;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_gender',
        'customer_phone',
        'customer_dob',
        'customer_email',
        'allow_credit',
        'customer_address',
        'customer_cnic',
        'customer_description',
        'customer_feature_img',
        'outlet_id',
        'created_by',
    ];

    // public function sales_order()
    // {
    //     return $this->hasMany(SalesOrder::class, 'customer_id');
    // }
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('customers.updated_at', '>=', $last_backup_date);
        }
    }

    public function customer_accounts()
    {
        return $this->hasMany(CustomerAccount::class);
    }
    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class);
    }
}
