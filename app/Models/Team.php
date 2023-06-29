<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
    use HasFactory;
    
    public function posts()   
    {
        return $this->belongsToMany(Post::class);
    }
    
    public function getByTeam(int $limit_count = 5)
    {
         return $this->posts()->with('teams')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}