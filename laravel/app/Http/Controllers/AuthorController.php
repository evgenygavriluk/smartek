<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    public function index(){
        $books = '';
        $authors = '';

        $author = new Author();

        $h1 = 'Все авторы';

        $elementsPerPage = 2;

        if(!isset($_GET['page'])){
            $firstPage = 1;
            $currentPage = 1;
        } else {
            $firstPage = 1;
            $currentPage = (int)$_GET['page'];
        }

        if ((int)($author->getAuthorsCnt()%$elementsPerPage) ==0) $allPages = (int)($author->getAuthorsCnt()/$elementsPerPage);
        else $allPages = (int)($author->getAuthorsCnt()/$elementsPerPage)+1;
        if ($currentPage<1 || $currentPage>$allPages) $currentPage = 1;
        if(isset($_GET['sort_type'])) $sortRule = $_GET['sort_type'];
        else $sortRule = 0;
        $authors = $author->showAuthorList($currentPage, $elementsPerPage, $sortRule);

        return view('author',['h1'=>$h1, 'authors'=>$authors, 'currentPage'=>$currentPage, 'firstPage'=>$firstPage, 'allPages'=>$allPages]);
    }

    public function element($authorid){
        $h1=Author::getAuthorName($authorid);
        $books = Author::showAuthorBooks($authorid);
        //$route = Route::current();
        return view('author-element',['h1'=>$h1, 'books'=>$books]);

    }
}