<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSync extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'table_name',
        'action',
        'outlet_id',
    ];
}
