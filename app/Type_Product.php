<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Type_Product extends Model
{
    //Defined Table
    protected $table = 'type_product';

    //Set Relationship with Products / a type has many products
    public function products(){
        return $this->hasMany('CValenzuela\Product','type_id','id');
    }
}
