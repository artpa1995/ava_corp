<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTaxReturnsNewColumns extends Migration
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
            $table->string('tax_return_type')->after('company_status')->nullable();
            $table->text('filing_extension')->after('tax_return_type')->nullable();
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
            $table->dropColumn('tax_return_type');
            $table->dropColumn('filing_extension');
        });
    }
}
