<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Test extends Model
{
    public static function getQuery(){

    }


    public static function getQuery2(){
        $authorBooks='';
        $soauthorBooks='';
        $book = new Book();


        $result = DB::table('books')
                        ->join('bookauthor','books.bookid','=','bookauthor.bookid')
                        ->join('authors','authors.authorid','=','bookauthor.authorid')
                        ->where('author.authorid','=', $authorId)
                        ->select('book.bookid','book.bookname','book.bookimage')
                        ->get();

        $authorBooks.='<ul class="list-group">';

        $soauthorBooks.='<ul class="list-group"><h5>Книги в соавторстве</h5>';

        $soauthorBooksCnt=0;

        foreach($result as $list=>$elements){
            if (count($book->getBookAuthors($elements['bookid']))==1){
                $authorBooks.='<li class="list-group-item"><img src="pic/books/'.$elements['bookimage'].'" width="50px"><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
            }
            else if(count($book->getBookAuthors($elements['bookid']))>1){
                $soauthorBooksCnt++;
                $soauthorBooks.='<li class="list-group-item"><img src="pic/books/'.$elements['bookimage'].'" width="50px"><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
            }
        }
        $authorBooks.='</ul>';

        $soauthorBooks.='</ul>';

        if ($soauthorBooksCnt>0) return $authorBooks.$soauthorBooks;
        return $authorBooks;
    }
}
