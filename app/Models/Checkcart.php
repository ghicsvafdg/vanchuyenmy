<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkcart extends Model
{
    
        public function users(){
            return $this->beLongsTo('App\Models\User');
        }
}
