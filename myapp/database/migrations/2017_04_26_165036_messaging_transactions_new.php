<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagingTransactionsNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Messaging_transactions')) {
             Schema::create('Messaging_transactions', function($table) {
                $table->increments('id');
                $table->integer('messagingID')->references('id')->on('messaging');
                $table->integer('userID')->references('id')->on('users');
                $table->integer('readStatus')->default(0);
                $table->string('messageFlag')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Messaging_transactions');
        
    }
}
