<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticketing_airline_id');
            $table->string('ticket_no');
            $table->string('passenger_name');
            $table->string('sector');
            $table->date('flight_date');
            $table->string('class');
            $table->string('pax_type');
            $table->decimal('amount_sales');
            $table->string('invoice_no');
            $table->date('sales_date');
            $table->unsignedBigInteger('sales_by')->nullable();
            $table->text('sales_user_address')->nullable();
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
        Schema::dropIfExists('ticket_sales');
    }
}
