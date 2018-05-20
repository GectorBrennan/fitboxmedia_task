<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('hash', 8);
            $table->string('title');
            $table->decimal('cost', 12);
            $table->timestamps();

            $table->unique(['title', 'cost']);
        });
    }

}
