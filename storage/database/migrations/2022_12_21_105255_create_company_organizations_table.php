<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('owner_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->index()->nullable();
            $table->foreign('company_id')->references('id')->on('company_types')->onDelete('cascade');
            $table->bigInteger('industry_id')->unsigned()->index()->nullable();
            $table->foreign('industry_id')->references('id')->on('industries_types')->onDelete('cascade');
            $table->integer('parent_id')->nullable();
            $table->string('company_phone')->nullable();
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
        Schema::dropIfExists('company_organizations');
    }
}
