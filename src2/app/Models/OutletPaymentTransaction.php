<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletPaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method_id',
        'amount',
        'balance',
        'transaction_type',
        'system_remarks',
        'description',
        'payment_date',
        'order_id',
        'customer_id',
        'supplier_id',
        'outlet_id',
        'created_by',
    ];

    protected $casts = [
        'payment_date' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');

            $filter->where('outlet_payment_transactions.updated_at', '>=', $last_backup_date);
        }
    }

    public function scopeFilter($filter)
    {
        if (request()->payment_method_id != '') {
            $filter->where('outlet_payment_transactions.payment_method_id', request()->payment_method_id);
        }
    }
}
