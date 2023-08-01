<?php

namespace App\Http\Controllers;

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
        //  $client = new \GuzzleHttp\Client();
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
        //     }
         $keyword = $request->input('keyword');
         
        //  DD($category);
        $query =Post::where('category_id','=',$category->id);
        if(!empty($keyword))
        {
            // DD($keyword);
            $query->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->where('category_id','=',$category->id);
        }

        $category_data=$query->orderBy('created_at','desc')->get();
        return view('categories.index')->with(['posts' => $category_data,'category'=>$category,'categories'=>$category->get(),'teams'=>$team->get(),/*'standings'=>$standings,'fixturedatas'=>$fixturedatas*/]);
    }
    public function index_follow(Post $post,Request $request,Team $team,Category $category){
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
    //      $date=Carbon::now()->format("Y-m");
    //     // 繰り返し処理
    //     $fixturedatas=array();
    //     for($i=0;$i<380;$i++){
    //         $fixturedata=$fixtures['response'][$i];
    //         $fixture_date=$fixtures['response'][$i]['fixture']['date'];
    //         $fixture_date_new=substr( $fixture_date,0,7);
    //         if($fixture_date_new===$date){
    //             array_push($fixturedatas,$fixturedata);
    //         }
    //         //dd( $fixturedatas);
    //     }
        // 検索機能
        $keyword = $request->input('keyword');
        $query =Post::query();
        //dd(Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id')));
       $follow_posts=Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->where('category_id','=',$category->id)->latest()->get();
        
        if(!empty($keyword))
        {
            $follow_posts=Post::query()->whereIn('user_id',Auth::user()->follows()->pluck('follower_id'))->where('category_id','=',$category->id)->where('body','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->latest()->get();
        }
        // $post=$follow_posts->orderBy('created_at','desc')->get();
        return view('categories.index_follow')->with(['posts' => $follow_posts,'keyword',$keyword,'teams'=>$team->get(),'category'=>$category,'categories'=>$category->get(),/*'standings'=>$standings,'fixturedatas'=>$fixturedatas*/]);
    } 
}
