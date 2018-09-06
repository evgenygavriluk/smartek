<?php

namespace App\biblioglobus;

use DB;
use App\Book;

class Books
{
    // ******* Возвращает всю информацию о книге
    public static function getAllAboutBook($bookId){
        $result = Book::where('id','=', $bookId)->get();
        foreach($result as $res){
            return ['bookid'=>$bookId, 'bookname'=>$res->bookname, 'bookimage'=>$res->bookimage, 'bookdescription'=>$res->bookdescription];
        }
    }

    // ******* Возвращает название книги с bookid = $bookid
    public static function getBookName($bookId){
        return Book::where('id','=', $bookId)->value('bookname');
    }

    // ******* Возвращает рейтинг книги с bookid = $bookid
    public static function getBookScore($bookId){
        $commentscnt = Book::where('id', '=', $bookId)->value('commentscnt');
        $allballs = Book::where('id', '=', $bookId)->value('allballs');

        return $allballs/$commentscnt;
    }

    // ******* Возвращает список 5 самых рейтинговых книг
    public static function getBestFiveBooks(){
        $bookScore = array();
        $result = Book::all();

        foreach ($result as $elements)
        {
            if($elements->commentscnt>0) {
                $score = $elements->allballs / $elements->commentscnt;
            } else $score = 0;
            array_push($bookScore, ['bookid'=>$elements->id, 'bookname'=>$elements->bookname, 'bookimage'=>$elements->bookimage,'score'=>$score]);
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
        $book = Book::find($bookid);
        $book->commentscnt++;
        $book->allballs += $newBall;

        $book->save();
    }

    // ******* Возвращает описание книги с bookid = $bookid
    public static function getBookDescription($bookId){
        return Book::where('id','=',  $bookId)->value('bookdescription');
    }

    // ******* Возвращает  имя файла изображения книги
    public static function getBookImage($bookId){
        return Book::where('id','=', $bookId)->value('bookimage');
    }

    // ******* Возвращает автора(ов) книги с bookid = $bookid
    public static function getBookAuthors($bookid){
        $bookAuthors = array();
        $book = Book::find($bookid);
        $result = $book->authors;

        foreach($result as $elements){
            array_push($bookAuthors, $elements);
        }
        return $bookAuthors;
    }

    // ******* Возвращает список библиотек, в которых есть книга
    public static function getBookBiblioteks($bookId){
        $result = Book::find($bookId)->biblioteks;
        return $result;
    }
}