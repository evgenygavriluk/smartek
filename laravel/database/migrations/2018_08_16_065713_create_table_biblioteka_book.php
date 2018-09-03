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
        Schema::create('biblioteka_book', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('biblioteka_id')->unsigned();
            $table->integer('book_id')->unsigned();
        });
    }


    public function down()
    {
        Schema::dropIfExists('biblioteka_book');
    }
}
