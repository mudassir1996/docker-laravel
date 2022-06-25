<?php

namespace App\Models;

use App\Models\Airlines\PartyAccount;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Sales\SalesOrder;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'value',
        'outlet_id',
        'created_by',
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function customer_accounts()
    {
        return $this->hasMany(CustomerAccount::class, 'payment_type');
    }
    public function supplier_accounts()
    {
        return $this->hasMany(SupplierAccount::class, 'payment_type');
    }
    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class, 'payment_type');
    }
    public function purchase_orders()
    {
        return $this->hasMany(InventoryPurchaseOrder::class, 'payment_type');
    }
    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class, 'payment_type_id');
    }
    public function expense_transactions()
    {
        return $this->hasMany(ExpenseTransaction::class, 'payment_type');
    }
    public function party_accounts()
    {
        return $this->hasMany(PartyAccount::class, 'payment_type');
    }


    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');

            $filter->where('payment_types.updated_at', '>=', $last_backup_date);
        }
    }
}
