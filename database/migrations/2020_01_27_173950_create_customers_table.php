<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_type_id')->nullable();
            $table->bigInteger('serial_no')->nullable();
            $table->string('tracking_no')->nullable();
            $table->string('given_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('resident_type')->nullable();
            $table->string('nrb_residence_country')->nullable();
            $table->tinyInteger('gender')->comment('1=Male | 2=Female');
            $table->tinyInteger('type')->comment('1=Individual | 2=Group');
            $table->bigInteger('group_id')->nullable();
            $table->tinyInteger('management')->comment('1=Private | 2=Government');
            $table->tinyInteger('identity')->comment('1=NID | 2=Birth Certificate');
            $table->string('nid_number')->nullable();
            $table->string('birth_certificate_number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('mobile')->nullable();
            $table->tinyInteger('marital_status')->comment('1=Single | 2=Married | 3=Others');
            $table->text('current_address')->nullable();
            $table->string('current_police_station')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_postcode')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('permanent_police_station')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_postcode')->nullable();
            $table->string('photo')->nullable();
            $table->string('spouse_name')->nullable();
            $table->bigInteger('dependent_id')->nullable();
            $table->bigInteger('maharam_id')->nullable();
            $table->bigInteger('mahram_relation_id')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
