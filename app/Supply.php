<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    //Defined table
    protected $table = 'supplies';

    //Set Relationship with Provider / a supply belongs to one provider
    public function provider(){
        return $this->belongsTo('CValenzuela\Provider');
    }

    //Set Relationship with Products (RECIPE) /_ a supply belongs to many products
    public function products(){
        return $this->belongsToMany('CValenzuela\Product','product_suply');
    }
}
