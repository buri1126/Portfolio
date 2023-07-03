<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index(Category $category,Request $request,Post $post)
    {
         $keyword = $request->input('keyword');
         
        //  DD($category);
        $query =Post::where('category_id','=',$category->id);
        if(!empty($keyword))
        {
            // DD($keyword);
            $query->where('body','like','%'.$keyword.'%')->where('category_id','=',$category->id);
        }

        $category_data=$query->orderBy('created_at','desc')->paginate(5);
        return view('categories.index')->with(['posts' => $category_data,'category'=>$category]);
    }
}
