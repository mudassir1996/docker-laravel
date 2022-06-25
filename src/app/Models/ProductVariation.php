<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'variation_attribute_id',
        'cost_price',
        'retail_price',
        'units_in_stock',
        'sku',
        'stock_keeping',
        'minimum_threshold',
        'outlet_id',
    ];
}
