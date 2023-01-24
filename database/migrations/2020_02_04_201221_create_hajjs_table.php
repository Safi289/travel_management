<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHajjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hajjs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->default(1)->comment('1=Hajj | 2=Omra Hajj');
            $table->string('serial_no')->unique();
            $table->year('year')->nullable();
            $table->string('hijri')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('package_id')->nullable();
            $table->bigInteger('departure_status')->nullable();
            $table->bigInteger('payment_status')->default(0)->comment('0=Partially Paid | 1=Paid');
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
        Schema::dropIfExists('hajjs');
    }
}
