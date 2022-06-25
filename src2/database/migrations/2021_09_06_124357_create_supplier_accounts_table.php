<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount', 15, 2);
            $table->float('balance', 15, 2);
            $table->string('payment_type');
            $table->text('description')->nullable();
            $table->dateTime('payment_date');
            $table->integer('payment_method_id');
            $table->bigInteger('order_id')->default(0);
            $table->bigInteger('supplier_id');
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
        Schema::dropIfExists('supplier_accounts');
    }
}
