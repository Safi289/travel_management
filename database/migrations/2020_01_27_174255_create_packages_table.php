<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('package_type')->default(1)->comment('1=Hajj | 2=Omra Hajj');
            $table->string('package_name');
            $table->string('pack_code')->nullable();
            $table->year('year')->nullable();
            $table->string('hijri')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('no_of_days')->default(0);
            $table->date('makka_arrival_date')->nullable();
            $table->date('madina_arrival_date')->nullable();
            $table->date('makka_ziyarah_date')->nullable();
            $table->date('madinaa_ziyarah_date')->nullable();
            $table->bigInteger('hotel_id');
            $table->bigInteger('vehicle_id');
            $table->double('total_price')->default(0);
            $table->text('package_description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Inactive | 1=Active');
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
        Schema::dropIfExists('packages');
    }
}
