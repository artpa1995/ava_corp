<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_calls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('update_user_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('contact_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('related_to')->nullable();
            $table->text('comments')->nullable();
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->string('reminder_set')->nullable();
            $table->string('create_recurring_series_of_tasks')->nullable();
            $table->timestamp("date");
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
        Schema::dropIfExists('log_calls');
    }
}
