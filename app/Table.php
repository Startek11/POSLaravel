<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    // Defined table 
    protected $table = 'tables';
    // Set Relationship with tickets / a table has many tickets
    public function tickets(){
        return $this->hasMany('CValenzuela\Ticket');
    }
}
