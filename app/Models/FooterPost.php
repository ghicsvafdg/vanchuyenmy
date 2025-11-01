<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterPost extends Model
{
    protected $table = 'footer_posts';
    protected $fillable = ['category','title','filename','content', 'status'];
}
