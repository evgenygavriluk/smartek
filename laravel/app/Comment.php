<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // ******* Возвращает комментарии к книге
    public static function getBookComments($bId){
        $bookComments = array();
        $result = DB::table('comments')
            ->select('commenttext','commentraiting','commentatorname')
            ->where('bookid','=',$bId)
            ->orderBy('commentid', 'desc')
            ->get();

        foreach($result as $res){
            array_push($bookComments, $res);
        }
        return $bookComments;
    }

    // ******* Показывает комментарии к книге
    public static function showBookComments($bookid){
        $commentList = '';
        foreach(self::getBookComments($bookid) as $list=>$elements){
            $commentList .= '<div class="commentary alert alert-info""><p><strong>'.$elements['commentatorname'].'</strong> поставил книге '.$elements['commentraiting'].' баллов</p><em>'.$elements['commenttext'].'</em></div>';
        }
        return $commentList;
    }

    public function setBookComment($bId, $commentText, $commentRaiting=10, $comentatorName){
        try{
            $query = "INSERT INTO comment (bookid, commenttext, commentraiting, commentatorname) VALUES ($bId, \"$commentText\", $commentRaiting, \"$comentatorName\")";
            $result = $this->dbh->query($query);
            $book = new Book();
            $book->setBookScore($bId, $commentRaiting);
        } catch (PDOException $e){
            die('Не удалось записать комментарий: ' . $e->getMessage());
        }
    }

    // ******* Возвращает последние 5 комментариев
    public static function getLastFiveBookComments(){
        $bookComments = array();
        $result = DB::table('comments')
            ->join('books','comments.bookid','=','books.bookid')
            ->select('comments.commenttext','comments.commentraiting','comments.commentatorname','books.bookid','books.bookname')
            ->orderBy('commentid','desc')
            ->get();

        foreach($result as $res){
            array_push($bookComments, $res);
        }
        return $bookComments;
    }

    // ******* Показывает последние 5 комментариев
    public static function showLastFiveBookComments(){
        $commentList ='';
        foreach(self::getLastFiveBookComments() as $list=>$elements){
            $commentList .= '<div class="card border-secondary mb-3" style="max-width: 18rem;"><div class="card-header">'.$elements['commentatorname'].' прокомментировал книгу <a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></div><div class="card-body"><p class="card-text">'.$elements['commenttext'].'</p><small>Поставил баллов: '.$elements['commentraiting'].'</small></div></div>';
        }
        return $commentList;
    }

}