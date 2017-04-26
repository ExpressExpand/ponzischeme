<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMatchCounterMatchDateToDonationHelp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_helps', function(Blueprint $table) {
            $table->integer('matchCounter')->default(0);
            $table->timestamp('matchDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_helps', function($table)
        {
            $table->dropColumn('matchCounter');
            $table->dropColumn('matchDate');
        });
    }
}
