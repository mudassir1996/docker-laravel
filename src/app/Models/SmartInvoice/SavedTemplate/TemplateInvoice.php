<?php

namespace App\Models\SmartInvoice\SavedTemplate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'outlet_id',
        'invoice_title',
    ];
}
