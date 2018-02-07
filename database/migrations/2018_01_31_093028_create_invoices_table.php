<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            //

            $table->increments('invoiceID');
            $table->date('date');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->integer('customer',false,true);
            $table->foreign('customer')->references('customerID')->on('customers');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
        Schema::table('invoices', function (Blueprint $table) {
            //
            Schema::dropIfExists('invoices');
        });
    }
}
