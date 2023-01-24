<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passport_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('serial_no')->nullable();
            $table->string('status_name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('status_id')->nullable();
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
        Schema::dropIfExists('passport_statuses');
    }
}
