<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['order_code','address','user_id','price','status'];
    
    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail','orders_id','id');
    }

    public function userOrder()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function addressOrder()
    {
        return $this->belongsTo('App\Models\Address','address','id');
    }
}
