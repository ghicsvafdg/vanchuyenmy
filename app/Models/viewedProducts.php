<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class viewedProducts extends Model
{
    protected $table = 'viewed_products';
    protected $fillable = ['user_id','products_id'];

    public function viewedProduct()
    {
        return $this->belongsTo('App\Models\Product','products_id','id');
    }
}
