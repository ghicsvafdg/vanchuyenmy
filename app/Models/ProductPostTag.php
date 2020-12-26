<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPostTag extends Model
{
    protected $table = 'product_post_tags';
    protected $fillable = ['tags_id','products_id','posts_id'];

    public function getTag()
    {
        return $this->belongsTo('App\Models\Tag','tags_id','id');
    }

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product','products_id','id');
    }

    public function getPost()
    {
        return $this->belongsTo('App\Models\Post','posts_id','id');
    }

}
