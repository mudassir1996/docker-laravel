<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_title',
        'discount_description',
        'discount_value',
        'discount_type',
        'discount_status',
        'outlet_id',
        'created_by'
    ];
}
