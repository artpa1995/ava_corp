<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateCorpotateAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corporate_appointments', function (Blueprint $table) {
            $table->timestamp("appointed_date")->after('position_2')->nullable();
            $table->timestamp("appointment_terminated_date")->after('appointed_date')->nullable();
            $table->string("status", 255)->after('appointment_terminated_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corporate_appointments', function (Blueprint $table) {
            $table->dropColumn('appointed_date');
            $table->dropColumn('appointment_terminated_date');
            $table->dropColumn('status');
        });
    }
}
