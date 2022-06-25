<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_title',
        'company_address',
        'company_email',
        'company_phone',
        'company_description',
        'company_feature_img',
        'outlet_id',
        'created_by'
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_companies')->withTimestamps();
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
            $filter->where('companies.updated_at', '>=', $last_backup_date);
        }
    }
}
