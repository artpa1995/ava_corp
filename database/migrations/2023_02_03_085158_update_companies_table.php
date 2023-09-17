<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('companies', function(Blueprint $table)
        {
             $table->string('registration_status')->after('incorporation_date')->nullable();
             $table->string('tax_id_type')->after('registration_status')->nullable();
             $table->text('tax_id')->after('tax_id_type')->nullable();
             $table->text('tax_filing_code')->after('tax_id')->nullable();
             $table->timestamp('status_date')->after('tax_filing_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function(Blueprint $table)
        {
            $table->removeColumn('registration_status');
            $table->removeColumn('tax_id_type');
            $table->removeColumn('tax_id');
            $table->removeColumn('tax_filing_code');
            $table->removeColumn('status_date');
        });
    }
}
