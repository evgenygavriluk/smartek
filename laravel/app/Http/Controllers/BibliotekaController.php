<?php

namespace App\Http\Controllers;

use App\Biblioteka;
use App\Author;
use Illuminate\Http\Request;

class BibliotekaController extends Controller
{
    public function index(){
        $h1 = 'Библиотеки объединения "Библиоглобус"';
        $biblioteks = Biblioteka::showBibliotekaList();
        return view('biblioteka',['h1'=>$h1, 'biblioteks'=>$biblioteks]);

    }

    public function element($bibliotekaid){

        $h1 = Biblioteka::getBibliotekaName($bibliotekaid);
        $adress = Biblioteka::getBibliotekaAdress($bibliotekaid);
        $authors = Author::getAuthors($bibliotekaid);

        $elementsPerPage = 2;
        if(!isset($_GET['page'])){
            $firstPage = 1;
            $currentPage = 1;
        } else {
            $firstPage = 1;
            $currentPage = $_GET['page'];
        }
        if(!isset($_GET['author'])){
            $authorid = 0;
        } else {
            $authorid = (int)$_GET['author'];
        }
        if(isset($_GET['sort_type'])) $sortRule = $_GET['sort_type'];
        else $sortRule = 0;

        if ((int)(Biblioteka::getBibliotekaBookCnt($bibliotekaid, $authorid)%$elementsPerPage) ==0) $allPages = (int)(Biblioteka::getBibliotekaBookCnt($bibliotekaid,$authorid)/$elementsPerPage);
        else $allPages = (int)(Biblioteka::getBibliotekaBookCnt($bibliotekaid,$authorid)/$elementsPerPage)+1;

        if ($currentPage<1 || $currentPage>$allPages) $currentPage = 1;
        $books = Biblioteka::getContainBooks($bibliotekaid, $currentPage, $elementsPerPage, $authorid, $sortRule);
        return view('biblioteka-element',['h1'=>$h1, 'books'=>$books, 'adress'=>$adress, 'authors'=>$authors, 'currentPage'=>$currentPage, 'firstPage'=>$firstPage, 'allPages'=>$allPages]);
    }
}





