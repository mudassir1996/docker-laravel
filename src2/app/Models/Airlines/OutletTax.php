<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_title',
        'tax_description',
        'tax_value',
        'tax_type',
        'tax_status',
        'outlet_id',
        'created_by'
    ];
}
