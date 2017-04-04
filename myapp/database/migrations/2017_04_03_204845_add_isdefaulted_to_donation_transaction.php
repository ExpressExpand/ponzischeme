<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsdefaultedToDonationTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_help_transactions', function(Blueprint $table) {
            $table->integer('isDefaulted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('donation_help_transactions', function($table)
        {
            $table->dropColumn('isDefaulted');
        });
    }
}
