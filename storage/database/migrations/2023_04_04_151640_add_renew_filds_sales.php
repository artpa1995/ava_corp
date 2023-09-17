<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRenewFildsSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function(Blueprint $table)
        {
            $table->string('periodical_one_off')->after('set_price_time_spent')->nullable();
            $table->string('renew_indefinitely_renew_until')->after('periodical_one_off')->nullable();
            $table->string('renew_until_periods')->after('renew_indefinitely_renew_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function(Blueprint $table)
        {
            $table->dropColumn('periodical_one_off');
            $table->dropColumn('renew_indefinitely_renew_until');
            $table->dropColumn('renew_until_periods');
        });
    }
}
