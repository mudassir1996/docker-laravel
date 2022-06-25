<?php

namespace App\Models;

use App\Models\Inventory\InventoryPurchaseOrder;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_title',
        'supplier_address',
        'supplier_cnic',
        'supplier_email',
        'supplier_phone',
        'supplier_description',
        'supplier_feature_img',
        'supplier_outlet_id',
        'outlet_id',
        'created_by'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function company()
    {
        return $this->belongsToMany(Company::class, 'supplier_companies')->withTimestamps();
    }
    public function supplier_accounts()
    {
        return $this->hasMany(SupplierAccount::class);
    }
    public function purchase_orders()
    {
        return $this->hasMany(InventoryPurchaseOrder::class);
    }

    public function scopeFilter($filter)
    {
        // $filter->where('units_in_stock','<', 'minimum_threshold');
        if (request()->from_date && request()->to_date != null) {
            $fromDate = date('Y-m-d h:i:s', strtotime(request()->from_date));
            $toDate = date('Y-m-d h:i:s', strtotime(request()->to_date));
            $filter->whereBetween('inventory_purchase_orders.created_at', [$fromDate, $toDate]);
        }

        if (request()->supplier_id != null) {
            $filter->where('inventory_purchase_orders.supplier_id', request()->supplier_id);
        }
        if (request()->payment_type != null) {
            $filter->where('inventory_purchase_orders.payment_type', request()->payment_type);
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
            $filter->where('suppliers.updated_at', '>=', $last_backup_date);
        }
    }
}
