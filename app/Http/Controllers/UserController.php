<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Team;
use App\Models\Post;
use App\Models\Follower;
use App\Http\Requests\UserRequest;
use Cloudinary;

class UserController extends Controller
{
   public function profile(User $user,Follower $follower)
    {
        $Auth=Auth::id();
        $follow_count = $user->follows()->count();
        $follows=$user->follows()->get();
        //DD($follows);
        $followed_count = $user->followers()->count();
        $followers=$user->followers()->get();
        //dd($followers);
        $postscount=$user->getByUser()->count();
        $prevUrl = url()->previous();
        return view('users.profile')->with(['prevUrl'=>$prevUrl,'posts' => $user->getByUser(),'postscount'=>$postscount,'user'=>$user,'Auth'=>$Auth,'followcounts'=>$follow_count,'followercounts'=>$followed_count,'follows'=>$follows,'followers'=>$followers]);
        
    }
   public function edit(Team $team,Post $post,User $user) 
    {        
        return view('users.edit')->with(['post' => $post,'user'=>$user]);
    }
    public function update(UserRequest $request, User $user)
    {
        
        $input = $request['user'];
        // dd($input);
        $user->fill($input);
        $introduction = User::convertLink($request['user.info']);
        $user->info=$introduction;
        $user->save();
        return redirect('/users/' . $user->id);
    }
    public function follow(User $user,Follower $follower){
        $follow_count = $user->follows()->count();
        $follows=$user->follows()->orderBy('created_at','DESC')->get();
        $follower_count = $user->followers()->count();
        $followers=$user->followers()->get();
        
        return view('users.follow')->with(['follow_count'=>$follow_count,'follows'=>$follows,'follower_count'=>$follower_count,'followers'=>$followers,'user'=>$user]);
    }
    public function follower(User $user,Follower $follower){
        $follow_count = $user->follows()->count();
        $follows=$user->follows()->get();
        $follower_count = $user->followers()->count();
        $followers=$user->followers()->orderBy('created_at','DESC')->get();
       //dd($followers);
        return view('users.follower')->with(['follow_count'=>$follow_count,'follows'=>$follows,'follower_count'=>$follower_count,'followers'=>$followers,'user'=>$user]);
    }
    
}
