<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public function Category(){
    	return $this->belongsTo('App\Models\Category','id_type','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\Models\BillDetail','id_product','id');
    }
}
