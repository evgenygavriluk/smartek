<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    // ******* Возвращает общее количество авторов
    public static function getAuthorsCnt(){
        return DB::table('authors')->count();
    }

    // ******* Возвращает список авторов
    public static function showAuthorList($curPage, $elementsPerPage, $sortRule=0){

        $rangeStart = $curPage*$elementsPerPage-$elementsPerPage;
        if($sortRule==0) $sort = "ORDER BY authorname";
        else if($sortRule==1) $sort = "ORDER BY authorname DESC";
        $authorList='';
        $sql = "SELECT * FROM authors $sort LIMIT $elementsPerPage OFFSET $rangeStart";

        $result = DB::select($sql);

        foreach($result as $list=>$elements){
            $authorList.= '<tr><td><a href="?authorid='.$elements['authorid'].'">'.$elements['authorname'].'</a></td></tr>';
        }
        return $authorList;
    }


    // ******* Возвращает список авторов
    public static function getAuthors($where)
    {
        $tableList = array();

        if ($where == 0) $result = DB::table('authors')->get();
        else $result = DB::table('authors')
                ->distinct()
                ->select('authors.authorname', 'authors.authorid')
                ->join('bookauthor', 'authors.authorid','=', 'bookauthor.authorid')
                ->join('bibliotekabook', 'bibliotekabook.bookid', '=', 'bookauthor.bookid')
                ->where('bibliotekabook.bibliotekaid', '=', $where)
                ->get();

        foreach($result as $res){
            array_push($tableList, $res);
        }
        return $tableList;
    }

    // ******* Возвращает имя автора по его id
    public static function getAuthorName($authorId){
        return DB::table('authors')->where('authorid','=', $authorId)->value('authorname');
    }

    // ******* Возвращает 5 авторов, написавших больше всего книг
    public static function getFiveAuthorsHaveMoreBooks(){
        $authorBooksCnt=array();
        $result = DB::table('books')
            ->join('bookauthor', 'books.bookid','=','bookauthor.bookid')
            ->join('authors','authors.authorid','=','bookauthor.authorid')
            ->select('authors.authorid','authors.authorname','authors.authorimage','books.bookid')
            ->get();

        foreach($result as $list=>$elements){
            if(!array_key_exists($elements['authorid'], $authorBooksCnt)) {
                $cnt = 1;

                $authorBooksCnt[$elements['authorid']] = [
                    'authorid' => $elements['authorid'],
                    'authorname' => $elements['authorname'],
                    'authorimage' => $elements['authorimage'],
                    'books' => $cnt];
            } else {
                $cnt = $authorBooksCnt[$elements['authorid']]['books'];
                $cnt++;
                $authorBooksCnt[$elements['authorid']]['books'] = $cnt;
            }
        }

        usort($authorBooksCnt, function ($item1, $item2) {
            if ($item1['books'] == $item2['books']) return 0;
            return $item1['books'] > $item2['books'] ? -1 : 1;
        });
        return array_slice($authorBooksCnt, 0, 5);
    }

    // ******* Показывает 5 авторов, написавших больше всего книг
    public static function showFiveAuthorsHaveMoreBooks(){
        $fiveAuthorsList = '';
        foreach(self::getFiveAuthorsHaveMoreBooks() as $list=>$elements){
            $fiveAuthorsList .= '<div class="card border-secondary mb-3" style="width: 18rem;"><img class="card-img-top" src="pic/authors/'.$elements['authorimage'].'" alt="'.$elements['authorname'].'"><div class="card-body"><h5>'.$elements['authorname'].'</h5><a href="author.php?authorid='.$elements['authorid'].'" class="btn btn-primary">Об авторе</a></div></div>';
        }
        return $fiveAuthorsList;
    }

    // Показывает все книги автора с authorId = $authorId
    public static function showAuthorBooks($authorId){
        $authorBooks='';
        $soauthorBooks='';

        $query = "SELECT b.bookid, b.bookname, b.bookimage FROM books as b JOIN bookauthor ba ON b.bookid = ba.bookid JOIN authors a ON a.authorid = ba.authorid WHERE a.authorid = $authorId";
        $result = DB::select($query);

        $authorBooks.='<ul class="list-group">';

        $soauthorBooks.='<ul class="list-group"><h5>Книги в соавторстве</h5>';

        $soauthorBooksCnt=0;

        foreach($result as $list=>$elements){
            if (count(Book::getBookAuthors($elements['bookid']))==1){
                $authorBooks.='<li class="list-group-item"><img src="pic/books/'.$elements['bookimage'].'" width="50px"><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
            }
            else if(count(Book::getBookAuthors($elements['bookid']))>1){
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