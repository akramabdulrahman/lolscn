<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from')->unsigned();
            $table->integer('chat_id')->unsigned();
            $table->integer('allowed_to')->unsigned(); // 1,2,3,4,
            $table->string('body');
            $table->boolean('read'); // when the user clicks the message link , a request is sent to server
            //marking the message as read

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('messages');
    }

}
