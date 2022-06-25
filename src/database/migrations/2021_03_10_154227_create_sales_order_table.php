<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id');
            $table->decimal('total_bill', 15, 2);
            $table->decimal('so_discount_value', 15, 2);
            $table->decimal('so_discount_percentage');
            $table->decimal('so_tax_value', 15, 2);
            $table->decimal('so_tax_percentage');
            $table->decimal('amount_payable', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('change_back', 15, 2);
            $table->decimal('profit_percentage');
            $table->decimal('profit_value', 15, 2);
            $table->text('so_status');
            $table->text('payment_type');
            $table->integer('payment_method_id');
            $table->text('remarks')->nullable();
            $table->datetime('order_completion_date');
            $table->bigInteger('processing_person_id');
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
        Schema::dropIfExists('sales_orders');
    }
}
