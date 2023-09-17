<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleDeskTextFieldTaxReturn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_returns', function(Blueprint $table)
        {
            $table->text('google_drive')->after('LLC_Tax_Status_for_This_Tax_Year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_returns', function(Blueprint $table)
        {
            $table->dropColumn('google_drive');
        });
    }
}
