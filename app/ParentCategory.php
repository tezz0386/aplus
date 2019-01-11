<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    //
    protected $fillable=[

             'parent_name',
             'description'
    ];
    public function childs() {
    	return $this->hasMany('App\Category', 'cat_id');
    }
}
