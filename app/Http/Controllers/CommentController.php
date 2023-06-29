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
    public function comment(CommentRequest $request,Post $post,User $user )
    {
        $comment = new Comment();
        
        $comment ->post_id=$post->id;
        $comment ->user_id=Auth::id();
        $input=$request['comment'];
        $comment->fill($input)->save();
        
      return redirect('/posts/' . $post->id);
    }
    
    
}
