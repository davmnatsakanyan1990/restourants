<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile');
            $table->string('name');
            $table->string('intro');
            $table->string('address');
            $table->string('lat');
            $table->string('lon');
            $table->string('site');
            $table->integer('price_from');
            $table->integer('price_to');
            $table->time('wrk_hrs_from');
            $table->time('wrk_hrs_to');
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
        Schema::drop('places');
    }
}
