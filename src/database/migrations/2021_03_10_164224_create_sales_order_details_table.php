<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sales_order_id');
            $table->bigInteger('product_id');
            $table->decimal('cost_price', 15, 2);
            $table->decimal('retail_price', 15, 2);
            $table->decimal('quantity');
            $table->decimal('total_cost', 15, 2);
            $table->decimal('total_retail', 15, 2);
            $table->decimal('discount_value', 15, 2);
            $table->decimal('discount_percentage');
            $table->decimal('tax_value', 15, 2);
            $table->decimal('tax_percentage');
            $table->decimal('amount_payable', 15, 2);
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
        Schema::dropIfExists('sales_order_details');
    }
}
