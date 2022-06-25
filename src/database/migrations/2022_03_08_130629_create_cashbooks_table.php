<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('remarks')->nullable();
            $table->float('amount', 15, 2);
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('transaction_type');
            $table->bigInteger('payment_category_id');
            $table->bigInteger('payment_type_id');
            $table->dateTime('payment_date');
            $table->bigInteger('payment_method_id');
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
        Schema::dropIfExists('cashbooks');
    }
}
