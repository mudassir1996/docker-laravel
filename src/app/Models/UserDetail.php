<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'full_name',
        'phone',
        'cnic',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'profile_img'
    ];
}
