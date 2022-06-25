<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_id');
            $table->string('po_number')->nullable();
            $table->date('po_request_date');
            $table->date('po_expected_date');
            $table->date('po_purchased_date')->nullable();
            $table->string('po_status');
            $table->string('payment_type');
            $table->integer('payment_method_id');
            $table->decimal('total_bill', 15, 2);
            $table->decimal('po_discount_value', 15, 2);
            $table->decimal('po_discount_percentage');
            $table->decimal('amount_payable', 15, 2);
            $table->text('remarks')->nullable();
            $table->bigInteger('outlet_id');
            $table->bigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_purchase_orders');
    }
}
