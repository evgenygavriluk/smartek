<?php

namespace App\biblioglobus;

use DB;
use App\Book;

class Books
{
    // ******* Возвращает всю информацию о книге
    public static function getAllAboutBook($bookId){
        $result = Book::where('bookid','=', $bookId)->get();
        foreach($result as $res){
            return ['bookid'=>$bookId, 'bookname'=>$res->bookname, 'bookimage'=>$res->bookimage, 'bookdescription'=>$res->bookdescription];
        }
    }

    // ******* Возвращает название книги с bookid = $bookid
    public static function getBookName($bookId){
        return Book::where('bookid','=', $bookId)->value('bookname');
    }

    // ******* Возвращает рейтинг книги с bookid = $bookid
    public static function getBookScore($bookId){
        $commentscnt = Book::where('bookid', '=', $bookId)->value('commentscnt');
        $allballs = Book::where('bookid', '=', $bookId)->value('allballs');

        return $allballs/$commentscnt;
    }

    // ******* Возвращает список 5 самых рейтинговых книг
    public static function getBestFiveBooks(){
        $bookScore = array();
        $result = Book::all();

        foreach ($result as $elements)
        {
            if($elements['commentscnt']>0) {
                $score = $elements['allballs'] / $elements['commentscnt'];
            } else $score = 0;
            array_push($bookScore, ['bookid'=>$elements['bookid'], 'bookname'=>$elements['bookname'], 'bookimage'=>$elements['bookimage'],'score'=>$score]);
        }

        // Сортируем рейтинг по убыванию
        usort($bookScore, function($a, $b){
            if($a['score'] === $b['score'])
                return 0;

            return $a['score'] < $b['score'] ? 1 : -1;
        });

        return array_slice($bookScore, 0, 5);
    }

    // Записывает новые параметры для рейтинга (кол-во комментариев и общий балл
    public function setBookScore($bookid, $newBall){
        $currentBookComments = $this->getTableField('commentscnt', 'bookid', htmlspecialchars($bookid));
        $newBookComments = $currentBookComments+1;

        $currentAllBalls = $this->getTableField('allballs', 'bookid', htmlspecialchars($bookid));
        $newAllBalls = $currentAllBalls+$newBall;
        try{
            $query = "UPDATE books SET commentscnt=$newBookComments, allballs=$newAllBalls WHERE bookid=$bookid";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

    }

    // ******* Возвращает описание книги с bookid = $bookid
    public static function getBookDescription($bookId){
        return Book::where('bookid','=',  $bookId)->value('bookdescription');
    }

    // ******* Возвращает  имя файла изображения книги
    public static function getBookImage($bookId){
        return Book::where('bookid','=', $bookId)->value('bookimage');
    }

    // ******* Возвращает автора(ов) книги с bookid = $bookid
    public static function getBookAuthors($bookid){
        $bookAuthors = array();

        $result = DB::table('authors')
            ->join('book_author', 'authors.id','=','book_author.author_id')
            ->join('books', 'books.id','=','book_author.book_id')
            ->where('books.id','=', $bookid)
            ->select('authors.id','authors.authorname')
            ->get();
        foreach($result as $elements){
            array_push($bookAuthors, $elements);
        }
        return $bookAuthors;
    }

    /*
    // ******* Возвращает автора(ов) книги с bookid = $bookid
    public static function getBookAuthors($bookid){
        $bookAuthors = array();

        $result = DB::table('authors')
            ->join('bookauthor', 'authors.authorid','=','bookauthor.authorid')
            ->join('books', 'books.bookid','=','bookauthor.bookid')
            ->where('books.bookid','=', $bookid)
            ->select('authors.authorid','authors.authorname')
            ->get();
        foreach($result as $elements){
            array_push($bookAuthors, $elements);
        }
        return $bookAuthors;
    }
*/
    // ******* Возвращает список библиотек, в которых есть книга
    public static function getBookBiblioteks($bookId){
        $result = DB::table('biblioteks')
            ->join('bibliotekabook','biblioteks.bibliotekaid','=','bibliotekabook.bibliotekaid')
            ->where('bibliotekabook.bookid','=',$bookId)
            ->select('biblioteks.bibliotekaid','biblioteks.bibliotekatitle','biblioteks.bibliotekaadress')
            ->get();
        return $result;
    }
}