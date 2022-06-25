<?php

namespace App\Models\Airlines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_title',
        'party_phone',
        'party_regno',
        'party_email',
        'party_address',
        'allow_credit',
        'party_description',
        'party_feature_img',
        'outlet_id',
        'created_by'
    ];
}
