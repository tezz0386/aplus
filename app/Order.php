<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable=[
            'cart',
            'name',
            'card_holder_name',
            'address',
            'user_id',
            'contact'
    ];
    protected $hidden=[
           'user_id'
    ];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function transactions(){
        return $this->hasMany('App\Transaction', 'order_id');
    }
}
