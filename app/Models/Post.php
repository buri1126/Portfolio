<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Team;
use App\Models\Comment;


class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id',
        'image_url'
    ];
    public function getPaginateByLimit()
    {
        return $this::with(['category','user'])->orderBy('updated_at', 'DESC');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function teams()
    {
       return $this->belongsToMany(Team::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
   public function images()
   {
       return $this->belongsToMany(Image::class);
   }
   
   public function likes()
    {
        return $this->hasMany(Like::class,'post_id');
    }
   public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($id, $likers)) {
      return true;
    } else {
      return false;
    }
  }
  public function follow_posts(){
      foreach($this as $post){
            if( Auth::user()->isFollowing($post->id)){
                $follow_posts+=$post;
            }
      }
        return $follow_posts->orderBy('created_at','desc');
  }
  public  static function convertLink($plane_text)
    {
        //URL抽出の正規表現
        $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';

        //該当する文字列に処理
        $convert_text = preg_replace_callback($pattern,function ($matches) {

            return '<a href="'.$matches[0].'" class="body_link">'.$matches[0].'</a>';
        },htmlspecialchars($plane_text));

        return $convert_text;
    }
}
