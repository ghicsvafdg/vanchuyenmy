<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable=['category','title', 'author', 'description', 'content', 'slug', 'filename'];

    public function postCategory()
    {
        return $this->belongsTo('App\Models\PostCategory','category', 'id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    
}
