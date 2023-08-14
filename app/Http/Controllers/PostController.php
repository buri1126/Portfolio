<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // API処理
    //     $client = new \GuzzleHttp\Client();
    //     $response_standings = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/standings?season=2023&league=39', [
    //     	'headers' => [
    //     		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
    //     		'X-RapidAPI-Key' => 'bec5700bc8msh8eebc62e717579bp173f67jsnb80be10b42c4',
    //     	],
    //     ]);
    //     //dd($response);
    //     $standings=json_decode($response_standings->getBody(),true);
        
    //   $response_fixtures = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/fixtures?league=39&season=2023&timezone=asia%2Ftokyo', [
    // 	'headers' => [
    // 		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
    // 		'X-RapidAPI-Key' => 'bec5700bc8msh8eebc62e717579bp173f67jsnb80be10b42c4',
    // 	],
    // ]);
    //     $fixtures=json_decode($response_fixtures->getBody(),true);
    //     // 日時取得
    //      $date=Carbon::now()->format("Y-m-d");
    //     // 繰り返し処理
    //     $fixturedatas=array();
    //     for($i=0;$i<380;$i++){
    //         $fixturedata=$fixtures['response'][$i];
    //         $fixture_date=$fixtures['response'][$i]['fixture']['date'];
    //         $fixture_date_new=substr( $fixture_date,0,10);
    //         if($fixture_date_new===$date){
    //             array_push($fixturedatas,$fixturedata);
    //         }
    //         //dd( $fixturedatas);
    //     }
        // 検索機能
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
        
        
        return view('posts.index')->with(['posts' => $post,'postscount'=>$postscount,'keyword',$keyword,'teams'=>$team->get(),'categories'=>$category->get()/*,'standings'=>$standings,'fixturedatas'=>$fixturedatas*/]);  
    }
    public function index_follow(Post $post,Request $request,Team $team,Category $category)
    {
         // API処理
    //     $client = new \GuzzleHttp\Client();
    //     $response_standings = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/standings?season=2023&league=39', [
    //     	'headers' => [
    //     		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
    //     		'X-RapidAPI-Key' => 'bec5700bc8msh8eebc62e717579bp173f67jsnb80be10b42c4',
    //     	],
    //     ]);
    //     //dd($response);
    //     $standings=json_decode($response_standings->getBody(),true);
        
    //   $response_fixtures = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/fixtures?league=39&season=2023&timezone=asia%2Ftokyo', [
    // 	'headers' => [
    // 		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
    // 		'X-RapidAPI-Key' => 'bec5700bc8msh8eebc62e717579bp173f67jsnb80be10b42c4',
    // 	],
    // ]);
    //     $fixtures=json_decode($response_fixtures->getBody(),true);
    //     // 日時取得
    //      $date=Carbon::now()->format("Y-m-d");
    //     // 繰り返し処理
    //     $fixturedatas=array();
    //     for($i=0;$i<380;$i++){
    //         $fixturedata=$fixtures['response'][$i];
    //         $fixture_date=$fixtures['response'][$i]['fixture']['date'];
    //         $fixture_date_new=substr( $fixture_date,0,10);
    //         if($fixture_date_new===$date){
    //             array_push($fixturedatas,$fixturedata);
    //         }
    //         //dd( $fixturedatas);
    //     }
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
        return view('posts.index_follow')->with(['posts' => $follow_posts,'postscount'=>$postscount,'keyword',$keyword,'teams'=>$team->get(),'categories'=>$category->get()/*,'standings'=>$standings,'fixturedatas'=>$fixturedatas*/]);
    } 
    public function show(Post $post ,Image $image,Comment $comment,User $user)
    {
        $Auth=Auth::id();
        $introduction = Post::convertLink($post->body);
        $image_get=Image::where('post_id','=',$post->id)->get();
        $comment=Comment::Where('post_id','=',$post->id)->get();
        return view('posts.show')->with(['introduction'=>$introduction,'post' => $post,'images'=>$image_get,'comments'=>$comment,'Auth'=>$Auth,'user'=>$user]);
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
                $image_url=Cloudinary::upload($post_image->getRealPath(),['folder'=>'assets','width'=>1024,'height'=>640,'crop'=>'pad'])->getSecurePath();
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
                $image_url=Cloudinary::upload($post_image->getRealPath(),['folder'=>'assets','width'=>1024,'height'=>640,'crop'=>'pad'])->getSecurePath();
                    $image=New Image();
                    $image->post_id=$post->id;
                    $image->image_url=$image_url;
                    // DD($request);
                    $image->save();   
                
            }
        }
        return redirect('/posts/' . $post->id);
    }
    
   public function like($id)
    {
        Like::create([
          'post_id' => $id,
          'user_id' => Auth::id(),
        ]);
        session()->flash('success', 'You Liked the Post.');
        return redirect()->back();
    }
  public function unlike($id)
  {
    $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
    $like->delete();

    session()->flash('success', 'You Unliked the Reply.');

    return redirect()->back();
  }
    public function delete(Post $post,Comment $comment)
    {
        // DD($post);
        $post->delete();
        $comment_delete=Comment::where('post_id',$post->id);
        $comment_delete->delete();
        return redirect('/');
    }
}
