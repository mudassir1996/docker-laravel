<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationAttribute extends Model
{
    use HasFactory;
    protected  $fillable = [
        'variation_id',
        'value',
        'outlet_id',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_variations')->withTimestamps();
    }
}
