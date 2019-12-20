<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    public function isAdmin(){

    	if($this->role===1){
    		return true;
    	}else
    	{
    		return false;
    	}
    }
}
