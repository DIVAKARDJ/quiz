<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalRequestByPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_request_by_point', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('point')->default(0);
            $table->bigInteger('equivalent_currency')->default(0);
            $table->enum('withdrawal_by', ['Bank','Paypal','Admin Request'])->default('Admin Request');
            $table->enum('status', ['Requested','Approved','Withdrawn','Declined'])->default('Requested');
            $table->string('paypal_account_id',150)->nullable();
            $table->string('bank_name',150)->nullable();
            $table->string('bank_account_number',150)->nullable();
            $table->string('bank_account_name',150)->nullable();
            $table->string('bank_account_route',150)->nullable();
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
        Schema::dropIfExists('withdrawal_request_by_point');
    }
}
