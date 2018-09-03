<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBooks extends Migration
{

    public function up()
    {

        Schema::create('books',function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('bookname', 100);
            $table->string('bookpublicyear', 100);
            $table->integer('bookpages');
            $table->integer('bookthema');
            $table->string('bookdescription', 1000)->nullable();
            $table->string('bookimage', 20);
            $table->integer('commentscnt')->unsigned()->nullable();
            $table->integer('allballs')->unsigned()->nullable();
         });

    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
