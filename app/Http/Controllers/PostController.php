<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Http\Requests\PostRequest;
use Cloudinary;


class PostController extends Controller
{
    public function index(Post $post,Request $request)
    {
        $keyword = $request->input('keyword');
        $query =Post::query();
        if(!empty($keyword))
        {
            // DD($keyword);
            $query->where('body','like','%'.$keyword.'%');
        }
        $post=$query->orderBy('created_at','desc')->paginate(5);
        return view('posts.index')->with(['posts' => $post,'keyword',$keyword]);  
    }
    
    public function show(Post $post ,Image $image,Comment $comment)
    {
        $image_get=Image::where('post_id','=',$post->id)->get();
        $comment=Comment::Where('post_id','=',$post->id)->get();
        return view('posts.show')->with(['post' => $post,'images'=>$image_get,'comments'=>$comment]);
    }
    
   public function create(Category $category,Team $team)
    {
        return view('posts.create')->with(['categories' => $category->get(),'teams' => $team->get()]);
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
                $image_url=Cloudinary::upload($post_image->getRealPath())->getSecurePath();
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
        // $post_images=$request->file('files');
        $input_post = $request['post'];
        $input_teams= $request->teams_array;
        $post->fill($input_post)->save();
        $post->fill($input_teams)->save();
        $post->teams()->sync($input_teams);
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
