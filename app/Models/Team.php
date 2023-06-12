<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Team extends Model
{
    use HasFactory;
    
    public function posts()   
    {
        return $this->belongsToMany(Post::class);
    }
}
