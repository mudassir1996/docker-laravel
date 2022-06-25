<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'cost_price',
        'retail_price',
        'stock_keeping',
        'units_in_stock',
        'sku',
        'minimum_threshold',
        'outlet_id',
        'created_by',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');
            $filter->where('product_stocks.updated_at', '>=', $last_backup_date);
        }
    }

    public function scopeGetLowStock($filter)
    {
        $filter->where('product_stocks.stock_keeping', 1);
        $filter->where('product_stocks.units_in_stock', '=<', 'product_stocks.minimum_threshold');
        if (!empty(request()->company_id)) {
            $filter->where('products.company_id', request()->company_id);
        }
        if (!empty(request()->supplier_id)) {
            $supplier_selected = Supplier::where('outlet_id', session('outlet_id'))->where('id', request()->supplier_id)->first();
            $product_companies = $supplier_selected->company()->pluck('companies.id');
            $filter->whereIn('products.company_id', $product_companies);
        }
        return $filter;
    }
}
