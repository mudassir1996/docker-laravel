<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'attendance_status_id',
        'date',
        'remarks',
        'created_by',
        'outlet_id',
    ];
}
