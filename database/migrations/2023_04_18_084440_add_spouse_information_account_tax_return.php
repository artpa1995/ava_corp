<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpouseInformationAccountTaxReturn extends Migration
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
            $table->string('fullname')->after('filing_extension')->nullable();
            $table->string('SSN_or_ITIN')->after('fullname')->nullable();
            $table->timestamp('bday')->after('SSN_or_ITIN')->nullable();
            $table->string('country_id')->after('bday')->nullable();
            $table->string('disabled')->after('country_id')->nullable();
            $table->string('spouseed')->after('disabled')->nullable();
             
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
            $table->dropColumn('fullname');
            $table->dropColumn('SSN_or_ITIN');
            $table->dropColumn('bday');
            $table->dropColumn('country_id');
            $table->dropColumn('disabled');
            $table->dropColumn('spouseed');
        });
    }
}
