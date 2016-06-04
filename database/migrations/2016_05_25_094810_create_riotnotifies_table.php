<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiotnotifiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('riotnotifies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('summoner_id')->unsigned()->index();
            $table->integer('post_id')->unsigned()->index();
            $table->string('type');
            $table->morphs('riotable');
            
            
            $table->timestamps();

            $table->index('riotable_id');
            $table->index('riotable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('riotnotifies');
    }

}
