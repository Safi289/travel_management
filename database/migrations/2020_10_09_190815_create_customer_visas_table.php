<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_visas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name');
            $table->text('visa_collect_from')->nullable();
            $table->decimal('visa_fee', 10, 2)->default(0);
            $table->decimal('service_charge', 10, 2)->default(0);
            $table->unsignedBigInteger('customer_visa_type_id')->default(1);
            $table->string('visa_for_country')->nullable();
            $table->string('passport_number')->nullable();
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
        Schema::dropIfExists('customer_visas');
    }
}
