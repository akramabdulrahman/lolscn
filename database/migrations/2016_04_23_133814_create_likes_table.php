<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('likable');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->index('user_id');
            $table->index('likable_id');
            $table->index('likable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('likes');
    }

}
