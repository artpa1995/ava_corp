<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiredEntrieSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function(Blueprint $table)
        {
            $table->string('Expired_Entrie')->after('comment')->nullable();
            $table->string('Expired_Entrie_id')->after('Expired_Entrie')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function(Blueprint $table)
        {
            $table->dropColumn('Expired_Entrie');
            $table->dropColumn('Expired_Entrie_id');
        });
    }
}
