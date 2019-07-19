<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //Defined table
    protected $table = 'tickets';

    //Set Relationship with Table / a ticket belongs to one table
    public function table(){
        return $this->belongsTo('CValenzuela\Table');
    }

    //Set Relationship with Sale / a ticket belongsTo Sale
    public function sale(){
        return $this->belongsTo('CValenzuela\Sale');
    }

    //Set Ralationship with Product / a ticket belongsToMany Products
    public function products(){
        return $this->belongsToMany('CValenzuela\Product','ticket_product')->withPivot('cant','total');
    }
}
