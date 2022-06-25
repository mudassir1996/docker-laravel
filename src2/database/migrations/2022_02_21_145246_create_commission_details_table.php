<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('airline_order_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('value', 15, 2);
            $table->decimal('percentage', 3, 2);
            $table->string('type');
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
        Schema::dropIfExists('commission_details');
    }
}
