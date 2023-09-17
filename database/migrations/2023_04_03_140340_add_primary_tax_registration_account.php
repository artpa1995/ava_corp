<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaryTaxRegistrationAccount extends Migration
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
            $table->string('registration_status')->after('address_2_zip_code')->nullable();
            $table->string('tax_id_type')->after('registration_status')->nullable();
            $table->string('tax_id')->after('tax_id_type')->nullable();
            $table->string('status_date')->after('tax_id')->nullable();
            $table->string('tax_filing_code')->after('status_date')->nullable();
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
            $table->dropColumn('registration_status');
            $table->dropColumn('tax_id_type');
            $table->dropColumn('tax_id');
            $table->dropColumn('status_date');
            $table->dropColumn('tax_filing_code');

        });
    }
}
