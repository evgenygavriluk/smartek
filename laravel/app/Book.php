<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // ******* Возвращает всю информацию о книге
    public static function getAllAboutBook($bookId){
        $result = DB::table('books')->where('bookid','=', $bookId)->first();
        return $result;
    }

    // ******* Возвращает название книги с bookid = $bookid
    public static function getBookName($bookId){
        return DB::table('books')->where('bookid','=', $bookId)->value('bookname');
    }

    // ******* Возвращает рейтинг книги с bookid = $bookid
    public static function getBookScore($bookId){
        $commentscnt = DB::table('books')->where('bookid','=',$bookId)->value('commentscnt');
        $allballs = DB::table('books')->where('bookid','=',$bookId)->value('allballs');
        return $allballs/$commentscnt;
    }

    // ******* Возвращает список 5 самых рейтинговых книг
    public static function getBestFiveBooks(){
        $bookScore = array();
        $result = DB::table('books')->get();

        foreach ($result as $list=>$elements)
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
        return DB::table('books')->where('bookid','=', $bookId)->value('bookdescription');
    }

    // ******* Возвращает  имя файла изображения книги
    public static function getBookImage($bookId){
        return DB::table('books')->where('bookid','=', $bookId)->value('bookimage');
    }

    // ******* Возвращает автора(ов) книги с bookid = $bookid
    public static function getBookAuthors($bookid){
        $bookAuthors = array();

        $result = DB::table('authors')
            ->join('bookauthor', 'authors.authorid','=','bookauthor.authorid')
            ->join('books', 'books.bookid','=','bookauthor.bookid')
            ->where('books.bookid','=', 1)
            ->select('authors.authorid','authors.authorname')
            ->get();
        foreach($result as $elements){
            array_push($bookAuthors, $elements);
        }
        return $bookAuthors;
    }

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