<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reply_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->foreign('reply_id')
                ->after('id')
                ->references('id')->on('comments');
            $table->integer('story_id')->unsigned();
            $table->string('email');
            $table->text('comment')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('story_id')->references('id')->on('stories');
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
        Schema::dropIfExists('comments');
    }
}
