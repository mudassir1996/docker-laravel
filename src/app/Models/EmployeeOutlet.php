<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeOutlet extends Model
{
    protected $fillable = [
        'employee_login_id',
        'employee_id',
        'outlet_id',
        'created_by'
    ];
}
