<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxReturnAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_return_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('account_id')->unsigned()->index()->nullable();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->string('due_date')->nullable();
            $table->string('tax_start')->nullable();
            $table->string('tax_end')->nullable();
            $table->text('file_path')->nullable();
            $table->string('status')->nullable();
            $table->string('company_status')->nullable();
            $table->string('tax_return_type')->nullable();
            $table->text('filing_extension')->nullable();
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
        Schema::dropIfExists('tax_return_accounts');
    }
}
