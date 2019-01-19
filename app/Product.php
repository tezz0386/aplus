<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable=[
              'child_id',
              'm_id',
              'p_name',
              'description',
              'price',
              'discount',
              'qty',
              'available_qty',
              'color',
              'size',
              'status',
              'path'
        
    ];
    public function category(){
    	return $this->belongsTo('App\Category');
    }
    public function calculation(){
        return $this->hasMany('App\Calculation', 'p_id');
    }
}
