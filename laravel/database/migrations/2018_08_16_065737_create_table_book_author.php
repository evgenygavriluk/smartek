<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBookAuthor extends Migration
{

    public function up()
    {
        Schema::create('book_author', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->integer('author_id')->unsigned();
        });
    }


    public function down()
    {
        Schema::dropIfExists('book_author');
    }
}