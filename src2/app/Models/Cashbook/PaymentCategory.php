<?php

namespace App\Models\Cashbook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_category_title',
        'payment_category_description',
        'payment_category_status',
        'outlet_id',
        'created_by'
    ];
}
