<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Biblioteka extends Model
{
    // ******* Показывает список всех библиотек
    public static function showBibliotekaList(){
        $bibliotekaList = '<ul>';

        $result = DB::table('biblioteks')->get();
        foreach($result as $elements){
            $bibliotekaList.='<li><a href="?bibliotekaid='.$elements['bibliotekaid'].'">'.$elements['bibliotekatitle'].'</a> На хранении '.self::getBibliotekaBookCnt($elements['bibliotekaid']).' книг</li>';
        }
        $bibliotekaList.= '</ul>';
        return $bibliotekaList;
    }

    // ******* Возвращает название библиотеки по ее id
    public static function getBibliotekaName($bId){
        return DB::table('biblioteks')->where('bibliotekaid','=',$bId)->value('bibliotekatitle');

    }

    // ******* Возвращает адрес библиотеки по ее id
    public static function getBibliotekaAdress($bId){
        return DB::table('biblioteks')->where('bibliotekaid','=',$bId)->value('bibliotekaadress');
    }

    // ******* Возвращает количество книг в библиотеке по ее id и id автора
    public static function getBibliotekaBookCnt($bId=0, $authorId=0){
        if($bId==0 and $authorId==0) $result = DB::table('books')
                                        ->count();
        if($bId==0 and $authorId>0)  $result = DB::table('books')
                                        ->join('bookauthor', 'bookauthor.bookid', '=', 'books.bookid')
                                        ->where('bookauthor.authorid','=',$authorId)
                                        ->count();
        if($bId>0  and $authorId==0) $result = DB::table('bibliotekabook')
                                        ->where('bibliotekaid','=',$bId)
                                        ->count();
        if($bId>0  and $authorId>0)  $result = DB::table('bibliotekabook')
                                        ->join('bookauthor', 'bookauthor.bookid','=','bibliotekabook.bookid')
                                        ->where('bibliotekaid','=',$bId)
                                        ->where('authorid','=',$authorId)
                                        ->count();
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
            $sql = "SELECT b.bookid, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN bibliotekabook bb ON bb.bookid = b.bookid JOIN themes t ON t.themaid = b.bookthema WHERE bb.bibliotekaid = $bId $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }
        // Все книги какие есть
        if($bId==0 && $authorId==0) {
            $sql = "SELECT b.bookid, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN themes t ON t.themaid = b.bookthema $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }
        // Все книги автора authorId
        if($bId==0 && $authorId>0) {
            $sql = "SELECT b.bookid, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN themes t ON t.themaid = b.bookthema JOIN book_author ba ON ba.bookid = b.bookid WHERE ba.authorid = $authorId $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }
        // Книги автора authorId из библиотеки bId
        if($bId>0 && $authorId>0){
            $sql = "SELECT b.bookid, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM books as b JOIN bibliotekabook bb ON bb.bookid = b.bookid JOIN themes t ON t.themaid = b.bookthema JOIN book_author ba ON ba.bookid = b.bookid WHERE bb.bibliotekaid = $bId AND ba.authorid = $authorId $sort LIMIT $elementsPerPage OFFSET $rangeStart";
        }

        $result = DB::select($sql);

        foreach($result as $elements){
            $score = ($elements['allballs']>0 && $elements['commentscnt']>0)? (float)$elements['allballs']/$elements['commentscnt'] : 'Отзывов пока нет';
            $newBook= ['bookimage'      =>'pic/books/'.$elements['bookimage'],
                       'bookauthors'    => Book::getBookAuthors($elements['bookid']),
                       'bookid'         => $elements['bookid'],
                       'bookname'       => $elements['bookname'],
                       'bookpublicyear' => $elements['bookpublicyear'],
                       'themaname'      => $elements['themaname'],
                       'score'          => $score];
            array_push($bookList, $newBook);
        }
        return $bookList;
    }
}
