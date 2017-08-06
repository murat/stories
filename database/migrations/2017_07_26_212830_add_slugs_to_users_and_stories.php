<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugsToUsersAndStories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'stories', function (Blueprint $table) {
                $table->string('slug', 128)->after('id')
                    ->nullable()
                    ->unique();
            }
        );
        Schema::table(
            'users', function (Blueprint $table) {
                $table->string('slug', 128)->after('id')
                    ->nullable()
                    ->unique();
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
            'stories', function (Blueprint $table) {
                $table->dropColumn('slug');
            }
        );
        Schema::table(
            'users', function (Blueprint $table) {
                $table->dropColumn('slug');
            }
        );
    }
}
