<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'outlet_id',
        'created_by'
    ];
}
