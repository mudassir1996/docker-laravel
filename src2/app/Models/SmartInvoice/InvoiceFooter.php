<?php

namespace App\Models\SmartInvoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceFooter extends Model
{
    use HasFactory;
    protected $table = 'invoice_footer';
    protected $fillable = [
        'invoice_data_id',
        'option',
        'value',
        'outlet_id'
    ];
}
