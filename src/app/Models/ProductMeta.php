<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'custom_field_id',
        'value',
        'outlet_id',
    ];
}
