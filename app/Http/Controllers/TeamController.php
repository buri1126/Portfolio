<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Post;
use App\Models\Category;

class TeamController extends Controller
{
    public function index(Team $team,Post $post,Category $category,Request $request)
    {
        //  $keyword = $request->input('keyword');
         
        // $query =Post::where(
        //     //この部分
        // );
        // if(!empty($keyword))
        // {
        //     // DD($keyword);
        //     $query->where('body','like','%'.$keyword.'%')->where(
        //         //この部分
        //         );
        // }

        // $team_data=$query->orderBy('created_at','desc')->paginate(5);
        return view('teams.index')->with(['posts' => $team->getByTeam(),'teams'=>$team->get(),'categories'=>$category->get()]);
    }
}
