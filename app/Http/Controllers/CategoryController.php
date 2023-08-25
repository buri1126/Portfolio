<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index(Category $category,Request $request,Post $post,Team $team)
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
         
        //  DD($category);
        $query =Post::where('category_id','=',$category->id);
         $postscount=$query->count();
        if(!empty($keyword))
        {
            // DD($keyword);
            $query->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->where('category_id','=',$category->id);
            $postscount=$query->count();
        }
        $category_data=$query->orderBy('created_at','desc')->get();
        return view('categories.index')->with(['comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking,'posts' => $category_data,'postscount'=>$postscount,'category'=>$category,'categories'=>$category->get(),'teams'=>$team->get()]);
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
        $query =Post::query();
        //dd(Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id')));
       $follow_posts=Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->where('category_id','=',$category->id)->latest()->get();
         $postscount=$follow_posts->count();
        if(!empty($keyword))
        {
            $follow_posts=Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->where('category_id','=',$category->id)->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->latest()->get();
             $postscount=$follow_posts->count();
        }
        // $post=$follow_posts->orderBy('created_at','desc')->get();
        return view('categories.index_follow')->with(['comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking,'posts' => $follow_posts,'postscount'=>$postscount,'keyword',$keyword,'teams'=>$team->get(),'category'=>$category,'categories'=>$category->get()]);
    } 
}
