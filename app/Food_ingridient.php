<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_ingridient extends Model
{
	public $timestamps = false;

    public function ingridient(){
    	
    	return $this->hasOne('App\Ingridient', 'id', 'ingridient_id');
    }
}
