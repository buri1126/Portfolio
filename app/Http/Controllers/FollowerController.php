<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Post;

class FollowerController extends Controller
{
    public function follow(Post $post,User $user){
       
        $follow = Follower::create([
            'user_id' => \Auth::user()->id,
           'followers_id'=>$user->id
        ]);
        $follows_count = auth()->user()->follows()->get();
        $followers_count = auth()->user()->followers()->get();
         return redirect()->back();
    }
    public function unfollow(User $user) {
        $follow = Follower::where('user_id', \Auth::user()->id)->where('follower_id', $user->id)->first();
        $follow->delete();
        $follows_count = auth()->user()->follows()->get();
        $followers_count = auth()->user()->followers()->get();
        return redirect()->back();
    }   
    
}
