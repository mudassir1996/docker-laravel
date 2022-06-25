<?php

namespace App\Models;

use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Sales\SalesOrderDetail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_title',
        'product_description',
        'product_barcode',
        'product_allow_half',
        'product_status',
        'product_feature_img',
        'category_id',
        'company_id',
        'outlet_id',
        'created_by'
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
            $filter->whereBetween('sales_order_details.created_at', [$fromDate, $toDate]);
        } else {
            $filter->whereBetween('sales_order_details.created_at', [Carbon::today()->subDays(7)->format('Y-m-d h:i:s'), Carbon::today()->format('Y-m-d h:i:s')]);
        }
        if (request()->product_id != null) {
            $filter->where('sales_order_details.product_id', request()->product_id);
            $filter->where('inventory_purchase_orders.product_id', request()->product_id);
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

    public function product_metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function variation_attribute()
    {
        return $this->belongsToMany(VariationAttribute::class, 'product_variations')->withTimestamps();
    }

    public function product_stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function sales_order_details()
    {
        return $this->hasMany(SalesOrderDetail::class);
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
            $filter->where('products.updated_at', '>=', $last_backup_date);
        }
    }

    public function scopeSearch($filter)
    {
        // dd(request()->get('query'));
        if (request()->get('query'))
            $filter->where('product_title', 'like', '%' . request()->get('query') . '%');
        return $filter;
    }
}
