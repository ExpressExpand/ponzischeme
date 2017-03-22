<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DonationTransacations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_help_transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('donationHelpID');
            $table->string('recipientUserID');
            $table->string('payerUserID');
            $table->string('receiverConfirmed')->default(0);
            $table->string('payerConfirmed')->default(0);
            $table->integer('amount')->default(0);
            $table->string('filename');
            $table->string('fileHash');
            $table->integer('penaltyDate');
            $table->integer('matchDate');
            $table->string('fakePOP')->default('0');
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
        Schema::dropIfExists('donation_help_transactions');
    }
}
