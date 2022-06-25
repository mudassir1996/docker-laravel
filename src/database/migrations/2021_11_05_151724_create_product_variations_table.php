<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('variation_attribute_id');
            $table->decimal('cost_price');
            $table->decimal('retail_price');
            $table->boolean('stock_keeping');
            $table->decimal('units_in_stock');
            $table->string('sku');
            $table->integer('minimum_threshold');
            $table->bigInteger('created_by');
            $table->bigInteger('outlet_id');
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
        Schema::dropIfExists('product_variations');
    }
}
