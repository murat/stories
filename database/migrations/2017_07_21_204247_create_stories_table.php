<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function(Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable()->default(null);
            $table->text('body')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->integer('upvote_count')->default(0);
            $table->integer('view_count')->default(0);

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
        Schema::dropIfExists('stories');
    }
}
