<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('time_zone');
            $table->integer('postal_code');
            $table->integer('admin_id')->unsigned();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('billing_details');
    }
}
