<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('summoner_id')->unsigned();
            $table->boolean('win');
            $table->boolean('in_game');
            $table->integer('championId')->unsigned();;
            $table->integer('Riot_Id')->unsigned();
            $table->integer('spell1')->unsigned();;
            $table->integer('spell2')->unsigned();;
            $table->integer('item1')->nullable();
            $table->integer('item2')->nullable();
            $table->integer('item3')->nullable();
            $table->integer('item4')->nullable();
            $table->integer('item5')->nullable();
            $table->integer('item6')->nullable();
            $table->integer('item7')->nullable();
            $table->string('match_type');
            $table->integer('kills')->unsigned();;
            $table->integer('deaths')->unsigned();;
            $table->integer('assists')->unsigned();;
            $table->integer('level')->unsigned();;
            $table->integer('creeps')->unsigned();;
            $table->integer('duration')->unsigned();;
            $table->timestamp('date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('matches');
    }

}
