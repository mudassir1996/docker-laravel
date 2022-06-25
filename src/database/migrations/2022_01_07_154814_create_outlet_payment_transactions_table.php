<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletPaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_payment_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payment_method_id');
            $table->float('amount', 15, 2);
            $table->float('balance', 15, 2);
            $table->string('transaction_type');
            $table->string('system_remarks');
            $table->text('description')->nullable();
            $table->dateTime('payment_date');
            $table->bigInteger('order_id')->default(0);
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
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
        Schema::dropIfExists('outlet_payment_transactions');
    }
}
