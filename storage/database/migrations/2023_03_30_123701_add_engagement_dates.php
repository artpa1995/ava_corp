<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEngagementDates extends Migration
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
             
            $table->timestamp('engagement_start_date')->after('correspondence_state')->nullable();
            $table->timestamp('engagement_end_date')->after('engagement_start_date')->nullable();

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
            $table->dropColumn('engagement_start_date');
            $table->dropColumn('engagement_end_date');
        });
    }
}
