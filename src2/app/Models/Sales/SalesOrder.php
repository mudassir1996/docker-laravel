<?php

namespace App\Models\Sales;

use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'total_bill',
        'so_discount_value',
        'so_discount_percentage',
        'so_tax_value',
        'so_tax_percentage',
        'amount_payable',
        'amount_paid',
        'change_back',
        'profit_percentage',
        'profit_value',
        'so_status',
        'payment_type',
        'payment_method_id',
        'remarks',
        'order_completion_date',
        'processing_person_id',
        'outlet_id',
        'created_by',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeFilter($filter)
    {
        // $filter->where('units_in_stock','<', 'minimum_threshold');
        if (request()->min_total && request()->max_total != null) {
            $filter->whereBetween('sales_orders.amount_payable', [request()->min_total, request()->max_total]);
        }

        if (request()->from_date == request()->to_date) {
            $filter->whereDate('sales_orders.order_completion_date', '=', Carbon::today()->format('Y-m-d'));
        } else if (!empty(request()->from_date) && !empty(request()->to_date)) {
            $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
            $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));
            $filter->whereDate('sales_orders.order_completion_date', '>=', $fromDate);
            $filter->whereDate('sales_orders.order_completion_date', '<=', $toDate);
        } else if (empty(request()->from_date) && empty(request()->to_date)) {
            $filter->whereDate('sales_orders.order_completion_date', '=', Carbon::today()->format('Y-m-d'));
            // $filter->whereDate('customer_accounts.payment_date', '<=', Carbon::today()->format('Y-m-d'));
        }

        if (request()->status != NULL) {
            $filter->where('sales_orders.so_status', request()->status);
        }
        // if (request()->customer_id != NULL) {
        //     $filter->where('sales_orders.customer_id', request()->customer_id);
        // }

        if (request()->payment_type != NULL) {
            $filter->where('sales_orders.payment_type', request()->payment_type);
        }


        if (request()->created_by != NULL) {
            $filter->where('sales_orders.created_by', request()->created_by);
        }


        if (request()->sales_order_id != NULL) {
            $filter->where('sales_orders.id', request()->sales_order_id);
        }
        if (request()->remarks != NULL) {
            $filter->where('sales_orders.remarks', request()->remarks);
        }
        if (request()->customer_id != NULL) {
            $filter->where('sales_orders.customer_id', request()->customer_id);
        }
        if (request()->category_id != NULL) {
            $filter->where('categories.id', request()->category_id);
        }

        if (request()->payment_type != NULL) {
            $filter->where('sales_orders.payment_type', request()->payment_type);
        }
        if (request()->so_status != NULL) {
            $filter->where('sales_orders.so_status', request()->so_status);
        }
        return $filter;
    }
    public function sales_order_detail()
    {
        return $this->hasMany(SalesOrderDetail::class);
    }


    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('sales_orders.updated_at', '>=', $last_backup_date);
        }
    }
}
