<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    public $timestamps = false;

    public function food(){
    	return $this->belongsTo('App\Food');
    }


}
