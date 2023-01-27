<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
       
    ];

    public function users() 
    { 
        return $this->hasMany(User::class,'post_id','id'); 
    }
    public function comments() 
    { 
        return $this->hasMany(Comment::class,'post_id','id'); 
    }
}
