<?php

namespace App\Http\Controllers;

use App\Test;
use App\Book;
use App\Author;
use App\Biblioteka;
use App\biblioglobus\Biblioteks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    public function index(){

        dump(Biblioteks::getContainBooks(1, 1, 5, 0, 0));

/*
        $res = Book::whereHas('authors', function ($query) {
            $query->where('authorname', 'like', '%Гайдар%');
        })->get();;

        foreach ($res as $b) {
            echo $b->bookname.'<br />';
            dump($b->authors);
        }
*/
    }
}
