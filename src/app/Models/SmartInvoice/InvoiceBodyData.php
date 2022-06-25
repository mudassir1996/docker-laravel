<?php

namespace App\Models\SmartInvoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBodyData extends Model
{
    use HasFactory;
    protected $table = 'invoice_body_data';
    protected $fillable = [
        'invoice_data_id',
        'invoice_body_header_id',
        'value',
    ];
}
