<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Payment_ticket extends Model
{
    //Defined table
    protected $table = 'payment_ticket';

    //Set Relationship with Sale / a paymentTicket has one Sale
    public function sale(){
        return $this->belongsTo('CValenzuela\Sale','sale_code');
    }
}
