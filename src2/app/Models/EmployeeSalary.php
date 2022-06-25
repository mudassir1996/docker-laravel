<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'salary_type_id',
        'salary_amount',
        'starting_date',
        'joining_date',
        'per_hour_wage',
        'working_hours_per_day',
        'outlet_id',
    ];
}
