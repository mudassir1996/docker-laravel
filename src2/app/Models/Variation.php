<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $fillable = [
        'variation_title',
        'status',
        'outlet_id',
        'created_by',
    ];

    public function variation_attributes()
    {
        return $this->hasMany(VariationAttribute::class);
    }
}
