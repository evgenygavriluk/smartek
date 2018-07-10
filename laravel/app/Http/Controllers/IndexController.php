<?php

namespace App\Http\Controllers;

use App\Book;
use App\Comment;
use App\Author;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function index(){
       $h1="Главная";
       $bestFiveBooks = Book::getBestFiveBooks();
       $popularAuthors = Author::showFiveAuthorsHaveMoreBooks();
       $lastFiveComments = Comment::showLastFiveBookComments();

       return view('index',['h1'=>$h1, 'bestFiveBooks'=>$bestFiveBooks, 'popularAuthors'=>$popularAuthors, 'lastFiveComments'=>$lastFiveComments]);

   }
}
