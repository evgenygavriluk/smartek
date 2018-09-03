<?php

namespace App\biblioglobus;

use DB;
use App\Book;
use App\Author;
use App\Biblioteka;


class Biblioteks
{
    // ******* Возвращает список всех библиотек
    public static function getBibliotekaList(){
        $bibliotekaList = array();
        $result = Biblioteka::all();

        foreach($result as $res){
            $res = ['bibliotekaid' => $res->id,
                    'bibliotekatitle' => $res->bibliotekatitle,
                    'bibliotekaadress' => $res->bibliotekaadress,
                    'countBooks' => self::getBibliotekaBookCnt($res['bibliotekaid'])];


            array_push($bibliotekaList, $res);
        }
        return $bibliotekaList;
    }

    // ******* Возвращает название библиотеки по ее id
    public static function getBibliotekaName($bId){
        return Biblioteka::where('id','=', $bId)->value('bibliotekatitle');
    }

    // ******* Возвращает адрес библиотеки по ее id
    public static function getBibliotekaAdress($bId){
        return Biblioteka::where('id','=',$bId)->value('bibliotekaadress');
    }

    // ******* Возвращает количество книг в библиотеке по ее id и id автора
    public static function getBibliotekaBookCnt($bId=0, $authorId=0){
        if($bId==0 and $authorId==0) $result = Biblioteka::all()->count();
        if($bId==0 and $authorId>0)  $result = DB::table('books')
            ->join('book_author', 'book_author.bookid', '=', 'books.id')
            ->where('book_author.authorid','=',$authorId)
            ->get()
            ->count();
        if($bId>0  and $authorId==0) $result = DB::table('biblioteka_book')
            ->where('biblioteka_id','=',$bId)
            ->get()
            ->count();
        if($bId>0  and $authorId>0)  $result = DB::table('biblioteka_book')
            ->join('book_author', 'book_author.book_id','=','biblioteka_book.book_id')
            ->where('biblioteka_id','=',$bId)
            ->where('author_id','=',$authorId)
            ->get()
            ->count();
        //dump($result);
        return $result;
    }

    // Показывает все находящиеся в библиотеке книги
    public static function getContainBooks($bId=0, $curPage=1, $elementsPerPage=5, $authorId=0, $reitingSort=0){
        $rangeStart = $curPage*$elementsPerPage-$elementsPerPage;
        $bookList=array();
        $sql = '';

        if($reitingSort==0) $sort ='ORDER BY allballs/commentscnt';
        else $sort='ORDER BY allballs/commentscnt DESC';

        // Все книги из библиотеки bId
        if($bId>0 && $authorId==0) {
            $sql = "SELECT b.id, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN biblioteka_book bb ON bb.book_id = b.id JOIN themas t ON t.id = b.bookthema WHERE bb.biblioteka_id = $bId $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }
        // Все книги какие есть
        if($bId==0 && $authorId==0) {
            $sql = "SELECT b.id, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN themas t ON t.id = b.book_thema $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }
        // Все книги автора authorId
        if($bId==0 && $authorId>0) {
            $sql = "SELECT b.id, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN themas t ON t.id = b.book_thema JOIN book_author ba ON ba.book_id = b.id WHERE ba.author_id = $authorId $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }
        // Книги автора authorId из библиотеки bId
        if($bId>0 && $authorId>0){
            $sql = "SELECT b.id, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN biblioteka_book bb ON bb.id = b.id JOIN themas t ON t.id = b.bookthema JOIN book_author ba ON ba.id = b.id WHERE bb.biblioteka_id = $bId AND ba.author_id = $authorId $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }

        $result = DB::select($sql);

        foreach($result as $elements){
            $score = ($elements['allballs']>0 && $elements['commentscnt']>0)? (float)$elements['allballs']/$elements['commentscnt'] : 'Отзывов пока нет';
            $newBook= ['bookimage'      =>'pic/books/'.$elements['bookimage'],
                'bookauthors'    => Books::getBookAuthors($elements['id']),
                'bookid'         => $elements['id'],
                'bookname'       => $elements['bookname'],
                'bookpublicyear' => $elements['bookpublicyear'],
                'themaname'      => $elements['themaname'],
                'score'          => $score];
            array_push($bookList, $newBook);
        }
        return $bookList;
    }
}