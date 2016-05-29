<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('summoner_id')->unsigned();
            $table->integer('leaguepts');
            $table->string('queue_name');
            $table->string('in_series')->nullable();
            $table->boolean('fresh_blood');
            $table->boolean('hotstreak');
            $table->boolean('veteran');
            $table->boolean('inactive');
            $table->integer('wins');
            $table->integer('losses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('leagues');
    }

}
