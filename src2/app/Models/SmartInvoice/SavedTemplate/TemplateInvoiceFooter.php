<?php

namespace App\Models\SmartInvoice\SavedTemplate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateInvoiceFooter extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_invoice_data_id',
        'option',
        'value',
        'outlet_id'
    ];
}
