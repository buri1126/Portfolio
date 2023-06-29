<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Post;
use App\Http\Requests\UserRequest;
use Cloudinary;

class UserController extends Controller
{
   public function profile(User $user)
    {
        
        return view('users.profile')->with(['posts' => $user->getByUser(),'user'=>$user]);
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
}
