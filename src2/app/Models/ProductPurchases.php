<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPurchases extends Model
{
    protected $fillable = [
        'product_id',
        'cost_price',
        'retail_price',
        'quantity',
        'supplier_id',
        'purchase_date',
        'expiry_date',
        'payment_type',
        'payment_method_id',
        'outlet_id',
        'created_by',
    ];
}
