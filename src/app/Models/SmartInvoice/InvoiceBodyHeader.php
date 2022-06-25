<?php

namespace App\Models\SmartInvoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBodyHeader extends Model
{
    use HasFactory;
    protected $table = 'invoice_body_header';
    protected $fillable = [
        'invoice_data_id',
        'option',
        'value',
        'outlet_id'
    ];
}
