<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            //
            $table->increments('stockID');
            $table->string('sheet_type');
            $table->string('sheet_thickness');
            $table->double('price64');
            $table->double('price84');
            $table->double('sqft_price');
            $table->string('material');
            $table->integer('quantity');
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
        Schema::table('stocks', function (Blueprint $table) {
            //
            Schema::dropIfExists('stocks');
        });
    }
}
