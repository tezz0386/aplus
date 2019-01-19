<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    //
    protected $fillable=[
               'order_id',
               'user_id',
               'p_id',
               'qty'
    ];
    public function user(){
        return $this->belongsTo('App\USer');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
