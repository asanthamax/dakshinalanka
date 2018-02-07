<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailyjobs', function (Blueprint $table) {
            //
            $table->increments('jobID');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->integer('customerID',false,true);
            $table->foreign('customerID')->references('customerID')->on('customers');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $table->string('material');
            $table->string('thickness');
            $table->string('description');
            $table->date('date');
            $table->string('duration');
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
        Schema::table('dailyjobs', function (Blueprint $table) {
            //
            Schema::dropIfExists('dailyjobs');
        });
    }
}
