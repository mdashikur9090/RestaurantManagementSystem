<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order_item;

class Order extends Model
{
    public function orderItem(){
    	return $this->hasMany('App\Order_item');
    }
}
