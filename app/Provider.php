<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //Defined table
    protected $table = 'providers';

    //Set Relationship with Supply / a provider has many supplies
    public function supplies(){
        return $this->hasMany('CValenzuela\Supply');
    }
}
