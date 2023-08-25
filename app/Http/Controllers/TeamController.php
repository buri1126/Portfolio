<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;

class TeamController extends Controller
{
    public function index(Team $team,Post $post,Category $category,Request $request)
    {
        $likes_ranking = Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as like_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as like_sum_rank'))
        ->join('likes', 'posts.id', 'likes.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('like_sum_rank')
        ->get(10);
        $comments_ranking =Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as comment_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as comment_sum_rank'))
        ->join('comments', 'posts.id', 'comments.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('comment_sum_rank')
        ->get(10);
         $keyword = $request->input('keyword');
         
        $query =$team->posts();
        $postscount=$query->count();
        if(!empty($keyword))
        {
            // DD($keyword);
            $query->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->get();
            $postscount=$query->count();
        }

        $team_data=$query->orderBy('created_at','desc')->paginate(5);
        return view('teams.index')->with(['comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking,'posts' => $team_data,'postscount'=>$postscount,'team'=>$team,'teams'=>$team->get(),'categories'=>$category->get()]);
    }
    public function index_follow(Post $post,Request $request,Team $team,Category $category){
        $likes_ranking = Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as like_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as like_sum_rank'))
        ->join('likes', 'posts.id', 'likes.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('like_sum_rank')
        ->get(10);
        $comments_ranking =Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as comment_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as comment_sum_rank'))
        ->join('comments', 'posts.id', 'comments.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('comment_sum_rank')
        ->get(10);
       
        // 検索機能
        $keyword = $request->input('keyword');
        $query =$team->posts;
        //dd(Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id')));
       $follow_posts=$query->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'));
        $postscount=$follow_posts->count();
        //dd($follow_posts);
        if(!empty($keyword))
        {
            $follow_posts=$query->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->where('team_id','=',$team->id)->latest()->get();
            $postscount=$follow_posts->count();
        }
        // $post=$follow_posts->orderBy('created_at','desc')->get();
        return view('teams.index_follow')->with(['comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking,'posts' => $follow_posts,'postscount'=>$postscount,'keyword',$keyword,'team'=>$team,'teams'=>$team->get(),'categories'=>$category->get()]);
    } 
}
