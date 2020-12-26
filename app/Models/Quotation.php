<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotations';
    protected $fillable = ['link_product','product_name','product_info','filename','address','reply'];
}
