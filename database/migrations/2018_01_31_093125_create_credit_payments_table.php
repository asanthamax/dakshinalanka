<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_payments', function (Blueprint $table) {
            //
            $table->increments('recordID');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->integer('customer_id',false,true);
            $table->foreign('customer_id')->references('customerID')->on('customers');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $table->timestamps();
            $table->double('amount_paid');
            $table->double('outstanding_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_payments', function (Blueprint $table) {
            //
            Schema::dropIfExists('credit_payments');
        });
    }
}
