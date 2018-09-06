<?php

namespace App\Http\Controllers;

use App\biblioglobus\Biblioteks;
use App\biblioglobus\Authors;
use Illuminate\Http\Request;

class BibliotekaController extends Controller
{
    public function index(){
        $h1 = 'Библиотеки объединения "Библиоглобус"';
        $biblioteks = Biblioteks::getBibliotekaList();
        return view('biblioteka',['h1'=>$h1, 'biblioteks'=>$biblioteks]);

    }

    public function element($bibliotekaid, $authorid=0, $pageid=0, $sortRule=0){

        $h1 = Biblioteks::getBibliotekaName($bibliotekaid);
        $adress = Biblioteks::getBibliotekaAdress($bibliotekaid);
        $authors = Authors::getAuthors($bibliotekaid);
        $href= 'biblPageAuthor/sortrule';

        $elementsPerPage = 2;
        if($pageid==0){
            $firstPage = 1;
            $currentPage = 1;
        } else {
            $firstPage = 1;
            $currentPage = $pageid;
        }

        if ((int)(Biblioteks::getBibliotekaBookCnt($bibliotekaid, $authorid)%$elementsPerPage) ==0) $allPages = (int)(Biblioteks::getBibliotekaBookCnt($bibliotekaid,$authorid)/$elementsPerPage);
        else $allPages = (int)(Biblioteks::getBibliotekaBookCnt($bibliotekaid,$authorid)/$elementsPerPage)+1;

        if ($currentPage<1 || $currentPage>$allPages) $currentPage = 1;
        $books = Biblioteks::getContainBooks($bibliotekaid, $currentPage, $elementsPerPage, $authorid, $sortRule);

        return view('biblioteka-element',['h1'=>$h1,
                                          'books'=>$books,
                                          'adress'=>$adress,
                                          'authors'=>$authors,
                                          'currentPage'=>$currentPage,
                                          'firstPage'=>$firstPage,
                                          'allPages'=>$allPages,
                                          'id'=>$bibliotekaid,
                                          'href'=>$href,
                                          'authorid'=>$authorid,
                                          'sortRule'=>$sortRule]);
    }
}




