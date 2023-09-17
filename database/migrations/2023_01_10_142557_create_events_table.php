<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->string('update_user_id')->nullable();
            $table->string('contact_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('related_to')->nullable();
            $table->text('description')->nullable(); 
            $table->string('location')->nullable();
            $table->string('full_day_event')->nullable();
            $table->string('reminder_set')->nullable();
            $table->string('type')->nullable();
            $table->timestamp("start_date")->nullable();
            $table->string("start_time")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->string("end_time")->nullable();
            $table->string("date")->nullable();
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
        Schema::dropIfExists('events');
    }
}
