<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableThemes extends Migration
{

    public function up()
    {
        Schema::create('themas',function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('themaname', 30);
        });
    }


    public function down()
    {
        Schema::dropIfExists('themas');
    }
}
