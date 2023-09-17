<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailPhoneFieldsContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function(Blueprint $table)
        {
            $table->string('email_1')->after('mailing__zip_code')->nullable();
            $table->string('email_2')->after('email_1')->nullable();
            $table->string('email_3')->after('email_2')->nullable();
            $table->string('email_4')->after('email_3')->nullable();
            $table->string('phone_1')->after('email_4')->nullable();
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
        Schema::table('contacts', function(Blueprint $table)
        {
            $table->dropColumn('email_1');
            $table->dropColumn('email_2');
            $table->dropColumn('email_3');
            $table->dropColumn('email_4');
            $table->dropColumn('phone_1');
            $table->dropColumn('phone_2');
            $table->dropColumn('phone_3');
            $table->dropColumn('phone_4');
        });
    }
}
