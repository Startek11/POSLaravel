<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    public function user(){
        return $this->belongsTo('CValenzuela\User');
    }
}
