<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Comment;

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
        'image_url',
        'info',
        'team_id',
        'favoriteplayer',
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
     public function teams()
    {
       return $this->belongsToMany(Team::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
     public function getByUser(int $limit_count = 5)
    {
         return $this->posts()->with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
