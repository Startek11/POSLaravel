<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Defined Table
    protected $table = 'products';

    //Set Relationship with TypeProduct / a product belongs to one type
    public function type(){
        return $this->belongsTo('CValenzuela\Type_Product','type_id','id');
    }

    //Set Relationship with Ticket / a products belongsToMany Ticket
    public function tickets(){
        return $this->belongsToMany('CValenzuela\Ticket','product_ticket')->withPivot('cant','total');
    }

    //Set Relationship with Supply (RECIPE) / a products belongstoMany Supply
    public function supplies(){
        return $this->belongsToMany('CValenzuela\Supply','product_supply');
    }
}
