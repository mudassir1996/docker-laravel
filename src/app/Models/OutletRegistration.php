<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutletRegistration extends Model
{
    protected $fillable = [
        'registered_name',
        'registered_address',
        'registration_date',
        'status',
        'description',
        'outlet_id',
        'created_by',
    ];
}
