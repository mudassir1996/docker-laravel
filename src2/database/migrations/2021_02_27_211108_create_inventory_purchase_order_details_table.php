<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_purchase_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inventory_purchase_order_id');
            $table->bigInteger('product_id');
            $table->decimal('old_cost_price', 15, 2);
            $table->decimal('new_cost_price', 15, 2);
            $table->decimal('requested_quantity');
            $table->decimal('purchased_quantity');
            $table->decimal('item_total', 15, 2);
            $table->decimal('discount_value', 15, 2);
            $table->decimal('discount_percentage');
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
        Schema::dropIfExists('inventory_purchase_order_details');
    }
}
