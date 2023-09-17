<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStreedHouseNumberAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function(Blueprint $table)
        {
            $table->string('house_number')->after('address_provider')->nullable();
            $table->string('street')->after('house_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function(Blueprint $table)
        {
            $table->dropColumn('house_number');
            $table->dropColumn('street');
        });
    }
}
