<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToStoriesAndPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->integer('user_id')->after('id')
                  ->nullable()->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('user_id')
                  ->nullable()->unsigned();
            $table->foreign('user_id')->after('id')
                  ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function(Blueprint $table) {
            $table->dropForeign('stories_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
