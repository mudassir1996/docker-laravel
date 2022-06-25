<?php

namespace App\Models\SmartInvoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeaderData extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_data_id',
        'option',
        'value',
        'outlet_id'
    ];
}
