<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_title',
        'description',
        'outlet_id',
        'created_by',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'permission_roles')->withTimestamps();
    }
    public function employees()
    {
        return $this->belongsToMany(EmployeeLogin::class, 'employee_roles')->withTimestamps();
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');

            $filter->where('roles.updated_at', '>=', $last_backup_date);
        }
    }
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
