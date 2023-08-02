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
        return view('users.profile')->with(['posts' => $user->getByUser(),'postscount'=>$postscount,'user'=>$user,'Auth'=>$Auth,'followcounts'=>$follow_count,'followercounts'=>$followed_count,'follows'=>$follows,'followers'=>$followers]);
        
    }
    
   public function edit(Team $team,Post $post,User $user) 
    {
        return view('users.edit')->with(['post' => $post,'user'=>$user,'teams' => $team->get()]);
    }

    public function update(UserRequest $request, User $user)
    {
        $input = $request['user'];
        $input_teams = $request->teams_array;
        if($request->file('image')){ //画像ファイルが送られた時だけ処理が実行される
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_url' => $image_url];
        }
        $user->fill($input)->save();
        // DD($user);
        $user->teams()->sync($input_teams);
        return redirect('/users/' . $user->id);
    }
    public function follow_follower(User $user,Follower $follower){
        $follow_count = $user->follows()->count();
        $follows=$user->follows()->get();
        $follower_count = $user->followers()->count();
        $followers=$user->followers()->get();
        return view('users.follow_follower')->with(['follow_count'=>$follow_count,'follows'=>$follows,'follower_count'=>$follower_count,'followers'=>$followers]);
    }
    
}
