<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLLCTaxStatusforThisTaxYear extends Migration
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
            $table->string('LLC_Tax_Status_for_This_Tax_Year')->after('filing_extension')->nullable();
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
            $table->dropColumn('LLC_Tax_Status_for_This_Tax_Year');
        });
    }
}
