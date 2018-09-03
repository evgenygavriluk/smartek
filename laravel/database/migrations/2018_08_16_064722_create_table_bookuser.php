<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBookuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookuser',function(Blueprint $table){
            $table->increments('id');
            $table->string('useremail', 70);
            $table->string('userpassword', 32);
            $table->string('userfirstname', 30);
            $table->string('userlastname', 30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookuser');
    }
}
