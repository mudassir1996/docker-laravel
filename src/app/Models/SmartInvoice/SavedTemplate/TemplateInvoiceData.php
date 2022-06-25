<?php

namespace App\Models\SmartInvoice\SavedTemplate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateInvoiceData extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_invoice_id',
        'header_tag',
        'body_tag',
        'footer_tag',
        'outlet_id'
    ];
}
