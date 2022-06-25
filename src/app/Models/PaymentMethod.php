<?php

namespace App\Models;

use App\Models\Airlines\PartyAccount;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Sales\SalesOrder;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_title',
        'payment_type_id',
        'phone',
        'address',
        'payment_description',
        'outlet_id',
        'created_by',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function customer_accounts()
    {
        return $this->hasMany(CustomerAccount::class);
    }
    public function supplier_accounts()
    {
        return $this->hasMany(SupplierAccount::class);
    }
    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class);
    }
    public function purchase_orders()
    {
        return $this->hasMany(InventoryPurchaseOrder::class);
    }

    public function expense_transactions()
    {
        return $this->hasMany(ExpenseTransaction::class);
    }
    public function party_accounts()
    {
        return $this->hasMany(PartyAccount::class);
    }

    public function scopeDatasync($filter)
    {
        if (request()->last_backup_date != '') {
            $date = DateTime::createFromFormat("m/d/Y h:i:s A", request()->last_backup_date);
            $last_backup_date = $date->format('Y-m-d H:i:s');

            $filter->where('payment_methods.updated_at', '>=', $last_backup_date);
        }
    }
}
