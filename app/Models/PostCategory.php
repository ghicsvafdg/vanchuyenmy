<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\PostCategory as Authenticatable;

class PostCategory extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'post_categories';

    protected $fillable = ['title','parent_id','slug','order'];


    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany('App\Models\PostCategory','parent_id','id') ;
    }

    public function posts(){
        return $this->hasMany('App\Models\Post','category', 'id');
    }
}
