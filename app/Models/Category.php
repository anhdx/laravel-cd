<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "type_products";
    public function Product(){
    	return $this->hasMany('App\Models\Product','id_type','id');
    }
}
