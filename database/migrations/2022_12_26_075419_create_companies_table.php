<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id');
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('state_id')->nullable();
            $table->string('filing')->nullable();
            $table->string('filing_status')->nullable();
            $table->bigInteger('company_id')->unsigned()->index()->nullable();
            $table->foreign('company_id')->references('id')->on('company_types')->onDelete('cascade');
            $table->bigInteger('account_id')->unsigned()->index()->nullable();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->bigInteger('contact_id')->unsigned()->index()->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('sub_status')->nullable();
            $table->string('division')->nullable();
            $table->string('previous_name1')->nullable();
            $table->string('previous_name2')->nullable();
            $table->string('previous_name3')->nullable();
            $table->string('previous_name4')->nullable();
            $table->string('previous_name5')->nullable();

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
        Schema::dropIfExists('companies');
    }
}
