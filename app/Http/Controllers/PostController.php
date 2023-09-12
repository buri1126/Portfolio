<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
use App\Http\Requests\PostRequest;
// 日付取得のクラス
use Carbon\Carbon;
use Cloudinary;


class PostController extends Controller
{
    public function index(Post $post,Request $request,Team $team,Category $category)
    {
        $likes_ranking = Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as like_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as like_sum_rank'))
        ->join('likes', 'posts.id', 'likes.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('like_sum_rank')
        ->get();
        $comments_ranking =Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as comment_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as comment_sum_rank'))
        ->join('comments', 'posts.id', 'comments.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('comment_sum_rank')
        ->get();
        //dd($likes_ranking);
        $keyword = $request->input('keyword');
        $query =Post::query();
        $postscount=$query->count();
        if(!empty($keyword))
        {
            $query->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%');
            $postscount=$query->count();
        }
        //dd($postscount);
        $post=$query->orderBy('created_at','desc')->get();
        //フォロー中
        
        return view('posts.index')->with(['comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking,'posts' => $post,'postscount'=>$postscount,'keyword',$keyword,'teams'=>$team->get(),'categories'=>$category->get()]);  
    }
    public function index_follow(Post $post,Request $request,Team $team,Category $category)
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
        // 検索機能
        $keyword = $request->input('keyword');
        //dd(Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id')));
       $follow_posts=Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->latest()->get();
        $postscount=$follow_posts->count();
        if(!empty($keyword))
        {
            $follow_posts=Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->latest()->get();
            $postscount=$follow_posts->count();
        }
       //dd($postscount);
        return view('posts.index_follow')->with(['comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking,'posts' => $follow_posts,'postscount'=>$postscount,'keyword',$keyword,'teams'=>$team->get(),'categories'=>$category->get()]);
    } 
    public function show( Request $request,Post $post ,Image $image,Comment $comment,User $user)
    {
        // dd(empty($comment));
          $prevUrl = url()->previous();
          //dd($request);
        $Auth=Auth::id();
        $introduction = Post::convertLink($post->body);
        $image_get=Image::where('post_id','=',$post->id)->get();
        $comment=Comment::Where('post_id','=',$post->id)->get();
        return view('posts.show')->with(['prevUrl'=>$prevUrl,'introduction'=>$introduction,'post' => $post,'images'=>$image_get,'comments'=>$comment,'Auth'=>$Auth,'user'=>$user]);
    }
    public function like(Request $request)
    {
    $user_id = Auth::user()->id; 
    $post_id = $request->post_id;
    $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    if (!$already_liked) { 
        $like = new Like;
        $like->post_id = $post_id; 
        $like->user_id = $user_id;
        $like->save();
    } else {
        Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    
    $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
    $param = [
        'post_likes_count' => $post_likes_count,
    ];
    return response()->json($param);
}
   public function create(Category $category,Team $team)
    {
        $prevUrl = url()->previous();
        return view('posts.create')->with(['prevUrl'=>$prevUrl,'categories' => $category->get(),'teams' => $team->get()]);
    }
    public function store(PostRequest $request, Post $post)
    {
       
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id]; 
        $input_teams = $request->teams_array;
        $post->fill($input)->save();
        $post->teams()->attach($input_teams);
        // ここから写真の処理
        // DD($post_images);
        if($request->file('files')){
            $post_images=$request->file('files');
            foreach($post_images as $post_image){
                // DD($post_image);
                $image_url=Cloudinary::upload($post_image->getRealPath(),['folder'=>'assets','width'=>1024, "quality" => "auto",'height'=>640,'crop'=>'pad'])->getSecurePath();
                $image=New Image();
                $image->post_id=$post->id;
                $image->image_url=$image_url;
                // DD($request);
                $image->save();
            }
        }
        // DD($post);
        return redirect('/posts/' . $post->id);
    }
    public function edit(Post $post,Category $category,Team $team)
    {
        return view('posts.edit')->with(['post' => $post,'categories' => $category->get(),'teams' => $team->get()]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_teams= $request->teams_array;
        $post->fill($input_post)->save();
        $post->fill($input_teams)->save();
        $post->teams()->sync($input_teams);
        //dd($request->file('files'));
         if($request->file('files')){
            $post_images=$request->file('files');
            if($post->images()){
                    $image_delete=Image::where('post_id',$post->id);
                    $image_delete->delete();
                }
            foreach($post_images as $post_image){
                $image_url=Cloudinary::upload($post_image->getRealPath(),['folder'=>'assets','width'=>1024,'height'=>640, "quality" => "auto",'crop'=>'pad'])->getSecurePath();
                    $image=New Image();
                    $image->post_id=$post->id;
                    $image->image_url=$image_url;
                    // DD($request);
                    $image->save();   
                
            }
        }
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post,Comment $comment)
    {
        // DD($post);
        $post->delete();
        $comment_delete=Comment::where('post_id',$post->id);
        $comment_delete->delete();
        return redirect('/');
    }
    public function ranking_index(Post $post,Team $team,Category $category){
         $likes_ranking = Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as like_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as like_sum_rank'))
        ->join('likes', 'posts.id', 'likes.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('like_sum_rank')
        ->get();
        $comments_ranking =Post::query()
        ->select('posts.id','posts.title','posts.user_id','posts.created_at',DB::raw('COUNT(*) as comment_sum, RANK() OVER(ORDER BY COUNT(*) DESC) as comment_sum_rank'))
        ->join('comments', 'posts.id', 'comments.post_id')
        ->groupBy('posts.id','posts.title','posts.user_id','posts.created_at')->orderBy('comment_sum_rank')
        ->get();
        $prevUrl = url()->previous();
        
        return view('ranking')->with(['prevUrl'=>$prevUrl,'comments_ranking'=>$comments_ranking,'likes_ranking'=>$likes_ranking]);  

    }
}
