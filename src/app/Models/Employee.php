<?php

namespace App\Models;

use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Sales\SalesOrder;
use App\Models\Customer;
use App\Models\Sales\SalesOrderDetail;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_name',
        'employee_gender',
        'employee_phone',
        'employee_dob',
        'employee_email',
        'employee_address',
        'employee_cnic',
        'employee_status',
        'employee_description',
        'employee_feature_img',
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
            $filter->where('employees.updated_at', '>=', $last_backup_date);
        }
    }

    public function employee_login()
    {
        return $this->hasOne(EmployeeLogin::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'created_by');
    }
    public function companies()
    {
        return $this->hasMany(Company::class, 'created_by');
    }
    public function customers()
    {
        return $this->hasMany(Customer::class, 'created_by');
    }
    public function customer_accounts()
    {
        return $this->hasMany(CustomerAccount::class, 'created_by');
    }
    public function expense_categories()
    {
        return $this->hasMany(ExpenseCategory::class, 'created_by');
    }
    public function expense_transactions()
    {
        return $this->hasMany(ExpenseTransaction::class, 'created_by');
    }
    public function purchase_orders()
    {
        return $this->hasMany(InventoryPurchaseOrder::class, 'created_by');
    }
    public function purchase_order_details()
    {
        return $this->hasMany(InventoryPurchaseOrderDetail::class, 'created_by');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }
    // public function product_metas()
    // {
    //     return $this->hasMany(ProductMeta::class);
    // }

    // public function variation_attribute()
    // {
    //     return $this->belongsToMany(VariationAttribute::class, 'product_variations')->withTimestamps();
    // }

    public function product_stocks()
    {
        return $this->hasMany(ProductStock::class, 'created_by');
    }

    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class, 'created_by');
    }
    public function sales_order_details()
    {
        return $this->hasMany(SalesOrderDetail::class, 'created_by');
    }
    // public function roles()
    // {
    //     return $this->hasMany(Roles::class);
    // }
    // public function outlet_payments()
    // {
    //     return $this->hasMany(OutletPaymentTransaction::class);
    // }
    public function payment_types()
    {
        return $this->hasMany(PaymentType::class, 'created_by');
    }
    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class, 'created_by');
    }
}
