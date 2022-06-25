<?php

namespace App\Models\SmartInvoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'customer_id',
        'invoice_title',
    ];
}
