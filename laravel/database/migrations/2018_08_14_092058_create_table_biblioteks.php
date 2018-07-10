<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBiblioteks extends Migration
{

    public function up()
    {
        Schema::create('biblioteks',function(Blueprint $table){
            $table->increments('bibliotekaid');
            $table->string('bibliotekatitle', 30);
            $table->string('bibliotekaadress', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('biblioteks');
    }
}
