<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_party_id');
            $table->bigInteger('category_id');
            $table->bigInteger('supplier_party_id');
            $table->decimal('total_recievable', 15, 2);
            $table->decimal('airline_payable', 15, 2);
            $table->decimal('other_payable', 15, 2);
            $table->decimal('total_payable', 15, 2);
            $table->decimal('total_income', 15, 2);
            $table->decimal('tax_value', 15, 2);
            $table->decimal('discount_value', 15, 2);
            $table->decimal('comission_value', 15, 2);
            $table->decimal('amount_payable', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('change_back', 15, 2);
            $table->string('status');
            $table->bigInteger('payment_type_id');
            $table->bigInteger('payment_method_id');
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
        Schema::dropIfExists('airline_orders');
    }
}
