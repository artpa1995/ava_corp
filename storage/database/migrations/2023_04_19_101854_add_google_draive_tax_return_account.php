<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleDraiveTaxReturnAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_return_accounts', function(Blueprint $table)
        {
            $table->text('google_drive')->after('spouseed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_return_accounts', function(Blueprint $table)
        {
            $table->dropColumn('google_drive');
        });
    }
}
