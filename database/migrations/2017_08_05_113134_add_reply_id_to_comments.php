<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReplyIdToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'comments', function (Blueprint $table) {
                $table->integer('reply_id')->unsigned()
                    ->after('id')
                    ->nullable()
                    ->default(null);

                $table->foreign('reply_id')->after('id')
                    ->references('id')->on('comments');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'comments', function (Blueprint $table) {
                $table->dropColumn('reply_id');
            }
        );
    }
}
