<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('expense_category_id')->constrained('expense_categories');
            $table->foreignId('referred_user_id')->constrained('employees', 'id');
            $table->foreignId('outlet_id')->constrained('outlets');
            $table->text('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->text('payment_type');
            $table->integer('payment_method_id');
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
        Schema::dropIfExists('expense_transactions');
    }
}
