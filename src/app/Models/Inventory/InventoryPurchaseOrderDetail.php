<?php

namespace App\Models\Inventory;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class InventoryPurchaseOrderDetail extends Model
{
    protected $fillable = [
        'inventory_purchase_order_id',
        'product_id',
        'old_cost_price',
        'new_cost_price',
        'requested_quantity',
        'purchased_quantity',
        'item_total',
        'discount_value',
        'discount_percentage',
        'remarks',
        'outlet_id',
        'created_by',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeFilter($filter)
    {

        if (request()->from_date && request()->to_date != null) {
            $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
            $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));
            $filter->whereBetween('inventory_purchase_order_details.created_at', [$fromDate, $toDate]);
        }
        if (request()->category_id != null) {
            $filter->where('categories.id', request()->category_id);
        }
        if (request()->payment_type != null) {
            $filter->where('inventory_purchase_orders.payment_type', request()->payment_type);
        }
        if (request()->company_id != null) {
            $filter->where('companies.id', request()->company_id);
        }
        if (request()->created_by != null) {
            $filter->where('inventory_purchase_orders.created_by', request()->created_by);
        }
        return $filter;
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('inventory_purchase_order_details.updated_at', '>=', $last_backup_date);
        }
    }
}
