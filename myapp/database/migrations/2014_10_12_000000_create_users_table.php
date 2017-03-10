<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('phone')->unique()->nullable();
            $table->integer('isBlocked')->default(0)->unsigned();
            $table->string('bankName')->nullable();
            $table->string('bankAccountName')->nullable();
            $table->integer('bankAccountNumber')->nullable();
            $table->string('bitCoinAddress')->nullable();
            $table->string('avatar')->nullable();
            $table->string('relatedCountryID');
            $table->integer('credibilityScore')->default('100');
            // $table->string('referralEmail')
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
