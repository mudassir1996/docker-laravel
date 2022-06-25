<?php

namespace App\Models\Sales;

use App\Models\Product;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    protected $fillable = [
        'sales_order_id',
        'product_id',
        'cost_price',
        'retail_price',
        'quantity',
        'total_cost',
        'total_retail',
        'discount_value',
        'discount_percentage',
        'tax_value',
        'tax_percentage',
        'amount_payable',
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
        if (request()->from_date && request()->to_date != null) {
            $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
            $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));
            $filter->whereDate('sales_order_details.created_at', '>=', $fromDate);
            $filter->whereDate('sales_order_details.created_at', '<=', $toDate);
        } else {
            $filter->whereDate('sales_order_details.created_at', '=', Carbon::today());
        }
        if (request()->category_id != null) {
            $filter->where('categories.id', request()->category_id);
        }
        if (request()->company_id != null) {
            $filter->where('companies.id', request()->company_id);
        }

        if (request()->product_id != null) {
            $filter->where('sales_order_details.product_id', request()->product_id);
        }


        if (request()->customer_id != null) {
            $filter->where('sales_orders.customer_id', request()->customer_id);
        }
        if (request()->payment_type != null) {
            $filter->where('sales_orders.payment_type', request()->payment_type);
        }
        if (request()->created_by != null) {
            $filter->where('sales_orders.created_by', request()->created_by);
        }
        return $filter;
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('sales_order_details.updated_at', '>=', $last_backup_date);
        }
    }
}
