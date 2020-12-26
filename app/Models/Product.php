<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['product_code','category_id', 'name', 'slug','price',
                            'description', 'content', 'quantity', 
                            'size', 'filename','video'];
    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory','category_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    
}
