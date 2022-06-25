<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierCompany extends Model
{
    protected $fillable = [
        'supplier_id',
        'company_id',
        'outlet_id',
        'created_by'
    ];
}
