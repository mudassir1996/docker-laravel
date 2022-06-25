<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{

    protected $fillable = [
        'outlet_title',
        'is_supplier',
        'public_key',
        'outlet_slogan',
        'outlet_description',
        'outlet_phone',
        'outlet_alt_phone',
        'outlet_email',
        'outlet_address',
        'outlet_city',
        'outlet_state',
        'outlet_country',
        'outlet_feature_img',
        'outlet_opening_date',
        'outlet_registration_date',
        'location_point_id',
        'business_type_id',
        'outlet_status_id',
        'created_by',
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    // public function employee()
    // {
    //     return $this->belongsToMany(EmployeeLogin::class, 'employee_outlet')->withTimestamps();
    // }
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_type_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('outlets.updated_at', '>=', $last_backup_date);
        }
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
