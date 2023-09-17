<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



     public function up()
     {
         Schema::create('apps', function (Blueprint $table) {
             $table->id();
             $table->string('api_url')->nullable()->unique();
             $table->string('name')->nullable();
             $table->string('email')->unique()->nullable();
             $table->string('password');
             $table->string('api_key');
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
        Schema::dropIfExists('apps');
    }
}
