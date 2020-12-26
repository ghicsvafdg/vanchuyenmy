<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';

    protected $fillable = ['post_id', 'user_id', 'product_id', 'comment_id', 'content','product_id'];

    protected $hidden =['created_at', 'updated_at'];

    public function posts(){
        return $this->belongsTo('App\Models\Post');
    }

    public function products(){
        return $this->belongsTo('App\Models\Product');
    }

    public function users(){
        return $this->beLongsTo('App\Models\User','user_id','id');
    }

    public function comments(){
        return $this->belongsTo('App\Models\Comment');
    }
}
