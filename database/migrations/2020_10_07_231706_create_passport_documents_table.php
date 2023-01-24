<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passport_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_passport_id');
            $table->string('title')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('passport_documents');
    }
}
