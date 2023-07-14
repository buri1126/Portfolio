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
         $keyword = $request->input('keyword');
         
        $query =$team->posts();
           
        if(!empty($keyword))
        {
            // DD($keyword);
            $query->where('body','like','%'.$keyword.'%')->get();
        }

        $team_data=$query->orderBy('created_at','desc')->paginate(5);
        return view('teams.index')->with(['posts' => $team_data,'team'=>$team,'teams'=>$team->get(),'categories'=>$category->get()]);
    }
}
