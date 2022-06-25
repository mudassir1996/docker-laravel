<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LvMessageLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'body',
        'remarks',
        'status',
        'user_type',
        'created_by',
    ];
}
