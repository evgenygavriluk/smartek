<?php

namespace App;

use App\Author;
use App\Biblioteka;
use App\Thema;
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

    public function thema(){
        return $this->hasOne('App\Thema','id', 'bookthema');
    }
}