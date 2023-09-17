<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsRoleRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments_role_relations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('appointment_id')->unsigned()->index()->nullable();
            $table->foreign('appointment_id')->references('id')->on('corporate_appointments')->onDelete('cascade');
            $table->bigInteger('appointments_roles_id')->unsigned()->index()->nullable();
            $table->foreign('appointments_roles_id')->references('id')->on('appointments_roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments_role_relations');
    }
}
