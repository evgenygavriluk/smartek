<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    public function books(){
        return $this->belongsToMany('App\Book');
    }

}