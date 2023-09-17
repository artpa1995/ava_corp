<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddCommentAndDisengagement extends Migration
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
            $table->string('disengagement_reason')->after('google_drive')->nullable();
            $table->text('disengagement_comment')->after('disengagement_reason')->nullable();
            $table->bigInteger('note_id')->after('disengagement_comment')->nullable();

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
            $table->dropColumn('disengagement_reason');
            $table->dropColumn('disengagement_comment');
            $table->dropColumn('note_id');
        });
    }
}
