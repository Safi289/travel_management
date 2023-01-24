<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hotel_name')->nullable();
            $table->string('hotel_area')->nullable()->comment('Makka or Madina');
            $table->integer('no_of_rooms')->nullable();
            $table->integer('no_of_hajis')->nullable();
            $table->date('staying_start_date')->nullable();
            $table->date('staying_end_date')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
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
        Schema::dropIfExists('hotels');
    }
}
