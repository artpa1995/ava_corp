<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add4EmailFieldsAccount extends Migration
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
            $table->string('email_1')->after('google_drive')->nullable();
            $table->string('email_2')->after('email_1')->nullable();
            $table->string('email_3')->after('email_2')->nullable();
            $table->string('email_4')->after('email_3')->nullable();
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
            $table->dropColumn('email_1');
            $table->dropColumn('email_2');
            $table->dropColumn('email_3');
            $table->dropColumn('email_4');
        });
    }
}
