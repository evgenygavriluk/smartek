<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Biblioteka extends Model
{
    protected $table = 'biblioteks';

    public function books(){
        return $this->belongsToMany('App\Book', 'biblioteka_book');
    }

}
