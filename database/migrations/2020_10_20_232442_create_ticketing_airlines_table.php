<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketingAirlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketing_airlines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('airlines_name');
            $table->string('airlines_code', 2);
            $table->string('ticketing_serial', 3);
            $table->string('type')->nullable()->comment('IATA/NON IATA');
            $table->tinyInteger('status')->default(1)->comment('0=Inactive | 1=Active');
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
        Schema::dropIfExists('ticketing_airlines');
    }
}
