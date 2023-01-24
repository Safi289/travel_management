<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHajjPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hajj_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hajj_id')->nullable();
            $table->string('voucher_name')->unique();
            $table->tinyInteger('type')->default(1)->comment('1=Cash | 2=Bank/Cheque');
            $table->string('depositor_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('cheque_number')->nullable();
            $table->date('deposit_date')->nullable();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->tinyInteger('status')->default(0)->comment('0=Pending | 1=Paid');
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
        Schema::dropIfExists('hajj_payments');
    }
}
