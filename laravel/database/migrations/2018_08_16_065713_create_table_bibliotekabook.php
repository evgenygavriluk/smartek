<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBibliotekaBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibliotekabook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bibliotekaid');
            $table->integer('bookid');
        });
    }


    public function down()
    {
        Schema::dropIfExists('bibliotekabook');
    }
}
