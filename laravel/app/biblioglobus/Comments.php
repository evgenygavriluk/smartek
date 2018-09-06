<?php

namespace App\biblioglobus;

use DB;
use App\Comment;

class Comments
{
    // ******* Возвращает комментарии к книге
    public static function getBookComments($bId){
        $bookComments = array();
        $result = Comment::where('book_id','=',$bId)
            ->orderBy('id', 'desc')
            ->get();

        foreach($result as $res){
            array_push($bookComments, $res);
        }
        return $bookComments;
    }

    // Сохраняет комментарий к книге
    public function setBookComment($bId, $commentText, $commentRaiting=10, $comentatorName){
        $comment = new Comment;
        $comment->bookid = $bId;
        $comment->commenttext = $commentText;
        $comment->commentraiting = $commentRaiting;
        $comment->commentatorname = $comentatorName;
        $comment->save();


        $book = new Books();
        $book->setBookScore($bId, $commentRaiting);

    }

    // ******* Возвращает последние 5 комментариев
    public static function getLastFiveBookComments(){
        $bookComments = array();
        $result = DB::table('comments')
            ->join('books','comments.book_id','=','books.id')
            ->select('comments.commenttext','comments.commentraiting','comments.commentatorname','books.id','books.bookname')
            ->orderBy('id','desc')
            ->get();

        foreach($result as $res){
            array_push($bookComments, $res);
        }
        return $bookComments;
    }
}