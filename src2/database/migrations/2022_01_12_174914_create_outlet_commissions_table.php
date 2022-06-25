<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('commission_title');
            $table->text('commission_description')->nullable();
            $table->decimal('commission_value', 15, 2);
            $table->string('commission_type');
            $table->string('commission_status');
            $table->bigInteger('party_id');
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
        Schema::dropIfExists('outlet_commissions');
    }
}
