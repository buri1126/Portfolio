<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
    'title',
    'body',
    'category_id',
    'user_id',
];

    
    public function getPaginateByLimit(int $limit_count=5)
    {
        return $this::with(['category','user'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function team()
    {
       return $this->belongsToMany(Team::class);
    }
}
