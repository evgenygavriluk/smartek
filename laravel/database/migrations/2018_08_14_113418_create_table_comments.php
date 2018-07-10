<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{

    public function up()
    {
        Schema::create('comments',function(Blueprint $table){
            $table->increments('commentid');
            $table->integer('bookid');
            $table->string('commenttext', 2000);
            $table->integer('commentraiting')->nullable();
            $table->string('commentatorname', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
