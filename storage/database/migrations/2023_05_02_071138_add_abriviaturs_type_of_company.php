<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAbriviatursTypeOfCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_of_companeis', function(Blueprint $table)
        {
            $table->string('abbreviation')->after('countries')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_of_companeis', function(Blueprint $table)
        {
            $table->dropColumn('abbreviation');
        });
    }
}
