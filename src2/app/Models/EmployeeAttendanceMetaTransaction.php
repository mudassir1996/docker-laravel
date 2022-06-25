<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceMetaTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_attendance_meta_id',
        'per_hour_wage',
        'hours',
        'amount',
        'date',
        'outlet_id',
    ];
}
