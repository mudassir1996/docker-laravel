<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletInvoice extends Model
{
    protected $fillable = [
        'outlet_id',
        'invoice_layout_id',
        'title',
        'sub_heading_1',
        'sub_heading_2',
        'remarks',
        'created_by',
    ];
}
