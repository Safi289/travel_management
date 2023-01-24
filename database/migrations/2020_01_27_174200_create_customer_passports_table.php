<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_passports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('passport_type')->comment('1=General | 2=Government | 3=Others');
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->text('issue_location')->nullable();
            $table->string('box_no')->nullable();
            $table->bigInteger('reference_id')->nullable()->comment('reference_id should be customer_id');
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
        Schema::dropIfExists('customer_passports');
    }
}
