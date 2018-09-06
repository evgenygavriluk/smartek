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
/*
        // Получаем список всех книг у автора
        $author = Author::find(5);
        echo $author->authorname;

        $books = $author->books;
        foreach ($books as $b) {
            echo $b->bookname.'<br />';
        }

        echo $books->count();


        echo Author::find(5)->books->count();

        // Получаем список всех авторов у книги
        $book = Book::find(2);
        echo $book->bookname;

        $authors = $book->authors;
        foreach ($authors as $a) {
            echo $a->authorname.'<br />';
        }

        // Получаем список всех книг в библиотеке
        $biblioteka = Biblioteka::find(3);
        echo $biblioteka->bibliotekatitle;

        $books = $biblioteka->books;
        foreach ($books as $book){
            echo $book->bookname.'<br />';
        }

        // Все книги с темами
        $books = Book::all();
        foreach($books as $book){
            dump($book->thema);
        }*/

        dump($books = Author::find(5)->books);
        foreach($books as $book) {
            $biblioteks = $book->biblioteks;
            foreach($biblioteks as $biblioteka){
                dump($biblioteka);
            }
        }
    }
}
