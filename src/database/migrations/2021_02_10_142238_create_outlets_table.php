<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('outlet_title');
            $table->string('outlet_slogan')->nullable();
            $table->text('outlet_description')->nullable();
            $table->string('outlet_phone');
            $table->string('outlet_alt_phone')->nullable();
            $table->string('outlet_email')->nullable();
            $table->string('outlet_address')->nullable();
            $table->string('outlet_city');
            $table->string('outlet_state');
            $table->string('outlet_country');
            $table->string('outlet_feature_img');
            $table->date('outlet_opening_date');
            $table->dateTime('outlet_registration_date');
            $table->bigInteger('location_point_id');
            $table->bigInteger('business_type_id');
            $table->bigInteger('outlet_status_id');
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
        Schema::dropIfExists('outlets');
    }
}
