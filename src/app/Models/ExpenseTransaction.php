<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'payment_type',
        'payment_method_id',
        'expense_category_id',
        'referred_user_id',
        'outlet_id',
        'created_by'
    ];
    // public function scopeTest($filter)
    // {
    //     if (request()->from_date && request()->to_date != null) {
    //         $filter->whereDate('expense_transactions.updated_at', '=', Carbon::today());
    //     } else {
    //         $filter->whereDate('expense_transactions.created_at', '=', Carbon::today());
    //     }
    //     // $filter->whereDate('expense_transactions.created_at', '=', Carbon::today());
    //     return $filter;
    // }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeFilter($filter)
    {

        if (!empty(request()->from_date) && !empty(request()->to_date)) {
            $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
            $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));
            $filter->whereDate('expense_transactions.created_at', '>=', $fromDate);
            $filter->whereDate('expense_transactions.created_at', '<=', $toDate);
        } elseif (empty(request()->from_date) && empty(request()->to_date)) {
            $filter->whereDate('expense_transactions.created_at', '=', Carbon::today()->format('Y-m-d'));
        }
        // if (request()->from_date == '' && request()->to_date == '') {
        //     $filter->whereDate('expense_transactions.created_at', '=', Carbon::today());
        // }
        if (!empty(request()->date)) {
            $filter->whereDate('expense_transactions.created_at', '=', request()->date);
        }
        if (!empty(request()->expense_category_id)) {
            $filter->where('expense_transactions.expense_category_id', '=', request()->expense_category_id);
        }

        return $filter;
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('expense_transactions.updated_at', '>=', $last_backup_date);
        }
    }
}
