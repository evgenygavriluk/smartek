<?php

namespace App\Http\Controllers;

use App\biblioglobus\Books;
use App\biblioglobus\Biblioteks;
use App\biblioglobus\Comments;
use App\biblioglobus\Authors;


use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index($authorid=0, $pageid=0, $sortRule=0)
    {
        $h1 = 'Все книги объединения "Библиоглобус"';
        $href = 'bookPageAuthor/sortrule';
        $authors = Authors::getAuthors(0);

        $elementsPerPage = 2;

        if ($pageid==0) {
            $firstPage = 1;
            $currentPage = 1;
        } else {
            $firstPage = 1;
            $currentPage = $pageid;
        }

        if ((int)(Biblioteks::getBibliotekaBookCnt(0, $authorid) % $elementsPerPage) == 0) $allPages = (int)(Biblioteks::getBibliotekaBookCnt(0, $authorid) / $elementsPerPage);
        else $allPages = (int)(Biblioteks::getBibliotekaBookCnt(0, $authorid) / $elementsPerPage) + 1;
        if ($currentPage < 1 || $currentPage > $allPages) $currentPage = 1;
        $books = Biblioteks::getContainBooks(0, $currentPage, $elementsPerPage, $authorid, $sortRule);
        return view('book', ['h1' => $h1,
                             'books' => $books,
                             'currentPage' => $currentPage,
                             'firstPage' => $firstPage,
                             'allPages' => $allPages,
                             'id'=>null,
                             'href' => $href,
                             'authors'=>$authors,
                             'authorid'=>$authorid,
                             'sortRule'=>$sortRule]);
    }

    public function element($bookid)
    {
        $thisBook = Books::getAllAboutBook($bookid);
        $h1 = $thisBook['bookname'];
        $bookImage = $thisBook['bookimage'];
        $description = $thisBook['bookdescription'];
        $authors = Books::getBookAuthors($bookid);
        $bibliotecs = Books::getBookBiblioteks($bookid);
        $comments = Comments::getBookComments($bookid);
        return view('book-element', ['h1' => $h1,
                                     'bookImage' => $bookImage,
                                     'description' => $description,
                                     'authors' => $authors,
                                     'bibliotecs' => $bibliotecs,
                                     'comments' => $comments]);
    }
}