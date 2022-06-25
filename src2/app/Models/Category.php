<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class Category extends Model
{

    protected $fillable = [
        'category_title',
        'category_description',
        'category_feature_img',
        'outlet_id',
        'created_by'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');

            $filter->where('categories.updated_at', '>=', $last_backup_date);
        }
    }
}
