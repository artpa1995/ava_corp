<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateForFileTaxReturn extends Migration
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
            $table->string('file_date_1')->after('LLC_Tax_Status_for_This_Tax_Year')->nullable();
            $table->string('file_date_2')->after('file_date_1')->nullable();
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
            $table->dropColumn('file_date_1');
            $table->dropColumn('file_date_2');
        });
    }
}
