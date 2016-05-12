<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nickname');
            $table->string('avatar'); //user image
            $table->string('cover');
            $table->string('mobile')->unique()->nullable();
            $table->string('facebook_token');
            $table->string('facebook_id');
            $table->string('google_token');
            $table->string('google_id');
            $table->integer('country_id')->unsigned();
            $table->string('email')->unique();
            $table->boolean('verified')->default(false);
            $table->boolean('busy')->default(false);
            $table->string('token')->nullable();
            $table->string('password');
            $table->timestamp('dob');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
