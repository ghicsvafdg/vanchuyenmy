<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['product_id','size','color','price','quantity'];

    public function productOrder()
    {
        return $this->belongsTo('App\Models\Product','products_id','id');
    }
}
