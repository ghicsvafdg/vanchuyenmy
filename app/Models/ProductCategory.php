<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\ProductCategory as Authenticatable;

// class PostCategory extends Authenticatable
class ProductCategory extends Model
{
    //
    use Notifiable;
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = ['title','parent_id','order','slug','filename','icon'];


    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany('App\Models\ProductCategory','parent_id','id') ;
    }
    public function product(){
        return $this->hasMany('App\Models\Product','category_id','id');
    }
}
