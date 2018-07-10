<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBookAuthor extends Migration
{

    public function up()
    {
        Schema::create('bookauthor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bookid');
            $table->integer('authorid');
        });
    }


    public function down()
    {
        Schema::dropIfExists('bookauthor');
    }
}