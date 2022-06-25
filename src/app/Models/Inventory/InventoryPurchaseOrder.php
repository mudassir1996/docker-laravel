<?php

namespace App\Models\Inventory;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class InventoryPurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'po_number',
        'po_request_date',
        'po_expected_date',
        'po_purchased_date',
        'po_status',
        'payment_type',
        'payment_method_id',
        'total_bill',
        'po_discount_value',
        'po_discount_percentage',
        'amount_payable',
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
        // $filter->where('units_in_stock','<', 'minimum_threshold');
        if (request()->min_total && request()->max_total != null) {
            $filter->whereBetween('inventory_purchase_orders.amount_payable', [request()->min_total, request()->max_total]);
        }
        if (request()->from_date && request()->to_date != null) {
            $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
            $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));
            $filter->whereDate('inventory_purchase_orders.po_purchased_date', '>=', $fromDate);
            $filter->whereDate('inventory_purchase_orders.po_purchased_date', '<=', $toDate);
        }

        if (request()->po_number != null) {
            $filter->where('inventory_purchase_orders.po_number', request()->po_number);
        }
        if (request()->status != null) {
            $filter->where('inventory_purchase_orders.po_status', request()->status);
        }
        if (request()->po_status != null) {
            $filter->where('inventory_purchase_orders.po_status', request()->po_status);
        }
        if (request()->po_request_date != null) {
            $filter->where('inventory_purchase_orders.po_request_date', request()->po_request_date);
        }
        if (request()->po_expected_date != null) {
            $filter->where('inventory_purchase_orders.po_expected_date', request()->po_expected_date);
        }
        if (request()->po_purchased_date != null) {
            $filter->where('inventory_purchase_orders.po_purchased_date', request()->po_purchased_date);
        }
        if (request()->supplier_id != null) {
            $filter->where('inventory_purchase_orders.supplier_id', request()->supplier_id);
        }
        if (request()->payment_type != null) {
            $filter->where('inventory_purchase_orders.payment_type', request()->payment_type);
        }
        if (request()->created_by != null) {
            $filter->where('inventory_purchase_orders.created_by', request()->created_by);
        }
        return $filter;
    }

    public function purchase_order_details()
    {
        return $this->hasMany(InventoryPurchaseOrderDetail::class);
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('inventory_purchase_orders.updated_at', '>=', $last_backup_date);
        }
    }
}
