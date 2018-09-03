<?php

namespace App;

use App\Author;
use App\Biblioteka;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function authors(){
        return $this->belongsToMany('App\Author', 'book_author');
    }

    public function biblioteks(){
        return $this->belongsToMany('App\Biblioteka', 'biblioteka_book');
    }

}