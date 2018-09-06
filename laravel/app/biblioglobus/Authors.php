<?php

namespace App\biblioglobus;

use DB;
use App\Author;
use App\Biblioteka;
use App\Book;
class Authors
{

    // ******* Возвращает общее количество авторов
    public static function getAuthorsCnt(){
        return Author::all()->count();
    }

    // ******* Возвращает список авторов
    public static function getAuthorList($curPage, $elementsPerPage, $sortRule=0){
        $rangeStart = $curPage*$elementsPerPage-$elementsPerPage;
        if($sortRule==0) return Author::take($elementsPerPage)->skip($rangeStart)->orderBy('authorname')->get();
        else if($sortRule==1) return Author::take($elementsPerPage)->skip($rangeStart)->orderBy('authorname', 'desc')->get();
    }


    // ******* Возвращает список авторов
    public static function getAuthors($where)
    {
        $tableList = array();

        // Старая версия кода
        // if ($where == 0) $result = DB::table('authors')->get();
        // else $result = DB::table('authors')
        //    ->distinct()
        //    ->select('authors.authorname', 'authors.id')
        //    ->join('book_author', 'authors.id','=', 'book_author.author_id')
        //    ->join('biblioteka_book', 'biblioteka_book.book_id', '=', 'book_author.book_id')
        //    ->where('biblioteka_book.biblioteka_id', '=', $where)
        //    ->get();
        //**************************
        $result = array();
        if ($where == 0) $result = Author::all();
        else {
            $biblioteka = Biblioteka::find($where);
            $books = $biblioteka->books;
            foreach ($books as $book){
                $authors = $book->authors;
                foreach ($authors as $author){
                    array_push($result, $author);
                }
            }
        }
        //**************************
        foreach($result as $res){
            array_push($tableList, $res);
        }
        return $tableList;
    }

    // ******* Возвращает имя автора по его id
    public static function getAuthorName($authorId){
        return Author::where('id','=', $authorId)->value('authorname');
    }


    // ******* Возвращает 5 авторов, написавших больше всего книг
    public static function getFiveAuthorsHaveMoreBooks(){
        $authorBooksCnt=array();

        // Старая версия кода
        // $result = DB::table('books')
        //    ->join('book_author', 'books.id','=','book_author.book_id')
        //    ->join('authors','authors.id','=','book_author.author_id')
        //    ->select('authors.id','authors.authorname','authors.authorimage')
        //    ->get();
        //**************************
        $result = array();
        $books = Book::all();
        foreach($books as $book){
            $authors = $book->authors;
            foreach($authors as $author){
                array_push($result, $author);
            }
        }
        //**************************
        foreach($result as $elements){
            if(!array_key_exists($elements->id, $authorBooksCnt)) {
                $cnt = 1;
                $authorBooksCnt[$elements->id] = [
                    'authorid' => $elements->id,
                    'authorname' => $elements->authorname,
                    'authorimage' => $elements->authorimage,
                    'books' => $cnt];
            } else {
                $cnt = $authorBooksCnt[$elements->id]['books'];
                $cnt++;
                $authorBooksCnt[$elements->id]['books'] = $cnt;
            }
        }
        usort($authorBooksCnt, function ($item1, $item2) {
            if ($item1['books'] == $item2['books']) return 0;
            return $item1['books'] > $item2['books'] ? -1 : 1;
        });
        return array_slice($authorBooksCnt, 0, 5);
    }

    // Показывает все книги автора с authorId = $authorId
    public static function getAuthorBooks($authorId){
        $ownerBooks=array();
        $shareBooks=array();
        $authorBooks = array();

        // Старая версия кода
        //$query = "SELECT b.id, b.bookname, b.bookimage FROM books as b JOIN book_author ba ON b.id = ba.book_id JOIN authors a ON a.id = ba.author_id WHERE a.id = $authorId";
        //$result = DB::select($query);
        //**************************
        $author = Author::find($authorId);
        $result = $author->books;
        //**************************

        foreach($result as $elements){
            if (count(Books::getBookAuthors($elements->id))==1){
                array_push($ownerBooks, $elements);
            }
            else {
                array_push($shareBooks, $elements);
            }
        }
        array_push($authorBooks, $ownerBooks);
        array_push($authorBooks, $shareBooks);
        return $authorBooks;
    }
}