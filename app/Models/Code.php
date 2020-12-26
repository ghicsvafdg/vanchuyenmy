<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';
    
    protected $fillable = [
        'code', 'role', 'amount','limited', 'use_time', 'end_time', 'created_user'];

}
