<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_name');
            $table->string('employee_gender');
            $table->string('employee_phone')->nullable();
            $table->date('employee_dob')->nullable();
            $table->string('employee_email')->nullable();
            $table->string('employee_address')->nullable();
            $table->bigInteger('employee_cnic')->nullable();
            $table->string('employee_status');
            $table->text('employee_description')->nullable();
            $table->string('employee_feature_img');
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
        Schema::dropIfExists('employees');
    }
}
