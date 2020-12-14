<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use Auth;
use Debugbar;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
    }


    public function getFirstComments($id){
        //$comments = Comment::where('photo_id', $id)->limit(5)->get();
        //$comments = Comment::all()->where('photo_id', $id)->take(5);
        $comments = Comment::where('photo_id', $id)->orderByDesc('date')->take(3)->get();
        return $comments;
    }

    public function getAllComments($id){
        $comments = Comment::where('photo_id', $id)->orderByDesc('date')->get();
        return $comments;
    }

    public function createComment(Request $request){
        $userId = $_POST['user_id'];
        $photoId = $_POST['photo_id'];
        $comment = $_POST['comment'];

        $newComment = new Comment;
        $newComment->user_id = $userId;
        $newComment->comment = $comment;
        $newComment->date = date('Y-m-d H:i:s');
        $newComment->photo_id = $photoId;
        $newComment->save();

        header('Content-type: application/json');
        $data = (object)['comment' => $newComment, 'userFio' => $newComment->user->getFioAttribute()];
        echo json_encode($data);
    }

}
