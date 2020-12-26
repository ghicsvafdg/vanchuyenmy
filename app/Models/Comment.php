<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['post_id', 'user_id', 'content','product_id','rating_star'];

    protected $hidden = ['created_at', 'updated_at'];

    public function posts(){
        return $this->belongsTo('App\Models\Post','post_id', 'id');
    }

    public function products(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function users(){
        return $this->beLongsTo('App\Models\User','user_id','id');
    }
}
