<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;

    
	// protected $table = 'foods';

    public function food_ingridients(){

    	return $this->hasMany ('App\Food_ingridient');

    	// return $this->hasManyThrough(
     //        'App\Food_ingridient',
     //        'App\Ingridient',
     //        'ingridient_id', // Foreign key on users table...
     //        'ingridient_id', // Foreign key on posts table...
     //        'id', // Local key on food table...
     //        'ingridient_id' // Local key on food ingridient table...
     //    );
    }

    public function food_image(){
    	return $this->hasMany('App\Food_image');
    }

    public function food_type(){
        return $this->belongsTo('App\Food_type');
    }


    public function comment() {
    	return $this->hasMany('App\Food_comment');
    }



}
