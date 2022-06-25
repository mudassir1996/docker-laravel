<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('airline_order_id');
            $table->string('pax_title');
            $table->string('pax_name');
            $table->string('ticket_class');
            $table->string('flight_type');
            $table->string('ticket_number');
            $table->string('flight_number');
            $table->dateTime('departure_date');
            $table->string('sector');
            $table->string('route');
            $table->string('pnr');
            $table->string('gds_pnr');
            $table->text('remarks')->nullable();
            $table->decimal('base_price', 15, 2);
            $table->decimal('airline_discount_value', 15, 2);
            $table->decimal('total_ticket_value', 15, 2);
            $table->decimal('total_tax_value', 15, 2);
            $table->decimal('service_charges_value', 15, 2);
            $table->decimal('total_amount', 15, 2);
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
        Schema::dropIfExists('airline_tickets');
    }
}
