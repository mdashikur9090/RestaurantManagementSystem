<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_comment extends Model
{
	
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
