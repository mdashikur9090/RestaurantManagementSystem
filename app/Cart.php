<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function food(){
    	return $this->belongsTo('App\Food');
    }

    
}
