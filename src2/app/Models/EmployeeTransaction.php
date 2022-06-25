<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'payment_type_id',
        'amount',
        'balance',
        'remarks',
        'status',
        'date',
        'created_by',
        'outlet_id',
    ];
}
