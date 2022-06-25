<?php

namespace App\Models\SmartInvoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceData extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'header_tag',
        'body_tag',
        'footer_tag',
        'outlet_id'
    ];
}
