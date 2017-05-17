<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsBonusColumnToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->integer('isBonusCollected')->default(0);
            $table->integer('bonusAmount')->default(0);
            $table->string('bonusType')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('users', function($table)
        {
            $table->dropColumn('isBonusCollected');
            $table->dropColumn('bonusAmount');
            $table->dropColumn('bonusType');
        });
    }
}
