<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add4PhoneAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function(Blueprint $table)
        {
            $table->string('phone_1')->after('google_drive')->nullable();
            $table->string('phone_2')->after('phone_1')->nullable();
            $table->string('phone_3')->after('phone_2')->nullable();
            $table->string('phone_4')->after('phone_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function(Blueprint $table)
        {
            $table->dropColumn('phone_1');
            $table->dropColumn('phone_2');
            $table->dropColumn('phone_3');
            $table->dropColumn('phone_4');
        });
    }
}
