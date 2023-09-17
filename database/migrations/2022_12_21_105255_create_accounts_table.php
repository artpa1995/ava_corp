<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('owner_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->dropForeign('user_id'); //this is for delete Foreign
            $table->bigInteger('account_type_id')->unsigned()->index()->nullable();
            $table->foreign('account_type_id')->references('id')->on('company_types')->onDelete('cascade');
            $table->bigInteger('industry_id')->unsigned()->index()->nullable();
            $table->foreign('industry_id')->references('id')->on('industries_types')->onDelete('cascade');
            $table->integer('email')->nullable();
            $table->string('account_phone')->nullable();
            $table->integer('account_personality_type')->nullable();
            $table->string('account_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('employees')->nullable();
            $table->text('description')->nullable();
            $table->text('address_1_street')->nullable();
            $table->string('address_1_country')->nullable();
            $table->string('address_1_city')->nullable();
            $table->string('address_1_state')->nullable();
            $table->string('address_1_zip_code')->nullable();
            $table->text('address_2_street')->nullable();
            $table->string('address_2_country')->nullable();
            $table->string('address_2_city')->nullable();
            $table->string('address_2_state')->nullable();
            $table->string('address_2_zip_code')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
