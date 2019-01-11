<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable=[
          'child_name',
          'cat_id',
          'description'
    ];

    public function parent(){
    	return $this->belongsTo('App\ParentCategory', 'cat_id');
    }

     public function products(){
    	return $this->hasMany('App\Product', 'child_id');
    }
    
}
