<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Model;
 use Laravel\Scout\Searchable;
  
 class Post extends Model
 {
     use Searchable;

     public function searchableAs(): string
     {
        $user = User::find(1);
        $user->searchable();
         return 'posts_index';

        $results = User::search('')->get();
     }
 }











?>