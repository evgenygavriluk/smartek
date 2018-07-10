<?php

namespace App\Http\Controllers;

use App\Book;
use App\Biblioteka;
use App\Comment;


use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = '';

        $h1 = 'Все книги объединения "Библиоглобус"';

        $elementsPerPage = 2;

        if (!isset($_GET['page'])) {
            $firstPage = 1;
            $currentPage = 1;
        } else {
            $firstPage = 1;
            $currentPage = (int)$_GET['page'];
        }
        if (!isset($_GET['author'])) {
            $authorid = 0;
        } else {
            $authorid = (int)$_GET['author'];
        }
        if (isset($_GET['sort_type'])) $sortRule = $_GET['sort_type'];
        else $sortRule = 0;

        if ((int)(biblioteka::getBibliotekaBookCnt(0, $authorid) % $elementsPerPage) == 0) $allPages = (int)(biblioteka::getBibliotekaBookCnt(0, $authorid) / $elementsPerPage);
        else $allPages = (int)(biblioteka::getBibliotekaBookCnt(0, $authorid) / $elementsPerPage) + 1;
        if ($currentPage < 1 || $currentPage > $allPages) $currentPage = 1;
        $books = biblioteka::getContainBooks(0, $currentPage, $elementsPerPage, $authorid, $sortRule);
        return view('book', ['h1' => $h1, 'books' => $books, 'currentPage' => $currentPage, 'firstPage' => $firstPage, 'allPages' => $allPages]);
    }

    public function element($bookid)
    {
        $thisBook = Book::getAllAboutBook($bookid);
        $h1 = $thisBook['bookname'];
        $bookImage = $thisBook['bookimage'];
        $description = $thisBook['bookdescription'];
        $authors = Book::getBookAuthors($bookid);
        $bibliotecs = Book::getBookBiblioteks($bookid);
        $comments = Comment::showBookComments($bookid);
        return view('book-element', ['h1' => $h1, 'bookImage' => $bookImage, 'description' => $description, 'authors' => $authors, 'bibliotecs' => $bibliotecs, 'comments' => $comments]);
    }
}