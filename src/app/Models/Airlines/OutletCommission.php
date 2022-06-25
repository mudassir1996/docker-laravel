<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletCommission extends Model
{
    use HasFactory;
    protected $fillable = [
        'commission_title',
        'commission_description',
        'commission_value',
        'commission_type',
        'commission_status',
        'party_id',
        'outlet_id',
        'created_by'
    ];
}
