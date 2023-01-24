<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('group_type')->default(1)->comment('1=Hajj | 2=Omra Hajj');
            $table->string('group_name');
            $table->string('group_code')->unique();
            $table->string('leader_name')->nullable();
            $table->tinyInteger('management_type')->comment('0=Group Leader | 1=Office');
            $table->string('management_name')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
