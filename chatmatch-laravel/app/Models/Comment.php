<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
       
    ];

    public function users() 
    { 
        return $this->hasMany(User::class,'comment_id','id'); 
    }
    public function posts() 
    { 
        return $this->hasMany(Post::class,'comment_id','id'); 
    }
}
