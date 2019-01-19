<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable=[
                   'order_id',
                   'total_income',
                   'total_qty'
    ];
    public function order(){
        return $this->belongsTo('App\Order');
    }
}
