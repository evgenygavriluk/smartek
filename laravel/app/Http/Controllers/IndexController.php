<?php

namespace App\Http\Controllers;

use App\biblioglobus\Books;
use App\biblioglobus\Comments;
use App\biblioglobus\Authors;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function index(){
       $h1="Главная";
       $bestFiveBooks = Books::getBestFiveBooks();
       $popularAuthors = Authors::getFiveAuthorsHaveMoreBooks();
       $lastFiveComments = Comments::getLastFiveBookComments();

       return view('index',['h1'=>$h1, 'bestFiveBooks'=>$bestFiveBooks, 'popularAuthors'=>$popularAuthors, 'lastFiveComments'=>$lastFiveComments]);
   }
}
