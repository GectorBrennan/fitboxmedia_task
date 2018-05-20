<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
	        $table->char('hash', 8);
            $table->string('email');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
	        $table->string('password');

        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
