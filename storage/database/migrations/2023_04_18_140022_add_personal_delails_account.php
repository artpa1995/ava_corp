<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonalDelailsAccount extends Migration
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
            $table->timestamp('bday')->after('email_4')->nullable();
            $table->string('country_id')->after('bday')->nullable();
            $table->string('disabled_field')->after('country_id')->nullable();
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
            $table->dropColumn('bday');
            $table->dropColumn('country_id');
            $table->dropColumn('disabled_field');
        });
    }
}
