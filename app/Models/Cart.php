<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id','user_id','color','size','quantity']; 
    
    public function proInCart()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
