<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTokensTable extends Migration
{
    public function up()
    {
        Schema::create('auth_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->char('hash', 8);
            $table->string('token', 512);
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('auth_tokens');
    }
}
