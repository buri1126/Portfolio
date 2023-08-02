<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follower;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'info',
        'favoritePlayer',
        'favoriteTeam',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
     public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    // フォロー→フォロワー
    public function follows()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    public function follow($user_id)
   {
       return $this->follows()->attach($user_id);
   }
 
   public function unfollow($user_id)
   {
       return $this->follows()->detach($user_id);
   }
    public function isFollowing($user_id)
   {
       return (boolean) $this->follows()->where('follower_id', $user_id)->exists();
   }
//   public function isFollowings($user_id)
//   {
//       return (boolean) $this->follows()->where('user_id', $user_id)->first();
//   }
      public function isFollowed($user_id)
      {
          return (boolean) $this->followers()->where('user_id', $user_id)->first();
      }
    
     public function getByUser(int $limit_count = 5)
    {
         return $this->posts()->with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
