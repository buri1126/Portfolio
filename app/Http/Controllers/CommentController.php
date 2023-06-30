<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    //
    public function index(Comment $comment,Post $post)
    {
         $Auth=Auth::id();
        return redirect('/posts/' . $post->id)->with(['comment'=>$comment,'Auth'=>$Auth]);
    }
    
    public function comment(CommentRequest $request,Post $post,User $user )
    {
        $comment = new Comment();
        
        $comment ->post_id=$post->id;
        $comment ->user_id=Auth::id();
        $input=$request['comment'];
        $comment->fill($input)->save();
        //DD($comment);
      return redirect('/posts/' . $post->id);
    }
    
    public function delete(Comment $comment)
    {
        $post_id=$comment->post->id;
        // DD($comment);
        $comment->delete();
        return redirect('/posts/'.$post_id);
    }
    
    
}
