<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tax_title');
            $table->text('tax_description')->nullable();
            $table->decimal('tax_value', 15, 2);
            $table->string('tax_type');
            $table->string('tax_status');
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
        Schema::dropIfExists('outlet_taxes');
    }
}
