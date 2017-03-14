<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Helps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_helps', function(Blueprint $table) {
            $table->increments('id');
            $table->string('paymentType'); //bitcoin or bank
            $table->string('amount'); //will be in kobos
            $table->string('phGh');
            $table->integer('isConfirmed')->default('0');
            $table->integer('userID')->references('id')->on('users');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_helps');
    }
}
