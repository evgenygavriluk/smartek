<?php

namespace App\Http\Controllers;

use App\biblioglobus\Authors;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    public function index($pageid=0){
        $href = 'authorPage';
        $h1 = 'Все авторы';
        $elementsPerPage = 2;

        if($pageid==0){
            $firstPage = 1;
            $currentPage = 1;
        } else {
            $firstPage = 1;
            $currentPage = $pageid;
        }

        if ((int)(Authors::getAuthorsCnt()%$elementsPerPage) ==0) $allPages = (int)(Authors::getAuthorsCnt()/$elementsPerPage);
        else $allPages = (int)(Authors::getAuthorsCnt()/$elementsPerPage)+1;
        if ($currentPage<1 || $currentPage>$allPages) $currentPage = 1;
        if(isset($_GET['sort_type'])) $sortRule = $_GET['sort_type'];
        else $sortRule = 0;
        $authors = Authors::getAuthorList($currentPage, $elementsPerPage, $sortRule);

        return view('author',['h1'=>$h1, 'authors'=>$authors, 'currentPage'=>$currentPage, 'firstPage'=>$firstPage, 'allPages'=>$allPages, 'href'=>$href]);
    }

    public function element($authorid){
        $h1=Authors::getAuthorName($authorid);
        $books = Authors::getAuthorBooks($authorid);
        return view('author-element',['h1'=>$h1, 'books'=>$books]);

    }
}