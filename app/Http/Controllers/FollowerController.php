<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follower;
use App\Models\Post;

class FollowerController extends Controller
{
   public function follow(User $user)
   {
       $follower = auth()->user();
       $is_following = $follower->isFollowing($user->id);
      //dd($is_following);
       if(!$is_following) {
           $follower->follow($user->id);
           return back();
       }
   }
   public function unfollow(User $user)
   {
       $follower = auth()->user();
       $is_following = $follower->isFollowing($user->id);
       //dd($is_following);
       //dd($user);
       if($is_following) {
           $follower->unfollow($user->id);
           return back();
       }
   }
    
}
