<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAuthors extends Migration
{

    public function up()
    {

        Schema::create('authors',function(Blueprint $table){
           $table->increments('id')->unsigned();
           $table->string('authorname', 70);
           $table->string('authorimage', 35);
        });
    }


    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
