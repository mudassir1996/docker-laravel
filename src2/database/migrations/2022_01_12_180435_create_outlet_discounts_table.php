<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('discount_title');
            $table->text('discount_description')->nullable();
            $table->decimal('discount_value', 15, 2);
            $table->string('discount_type');
            $table->string('discount_status');
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
        Schema::dropIfExists('outlet_discounts');
    }
}
