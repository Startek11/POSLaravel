<?php

namespace CValenzuela;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //Defined table
    protected $table = 'sales';

    //Set Relationship with Ticket/ a sale hasOne Ticket
    public function ticket(){
        return $this->belongsTo('CValenzuela\Ticket','ticket_code');
    }

    //Set Relationship with Payment_ticket / a sale belongsTo Payment_ticket
    public function paymentTicket(){
        return $this->belongsTo('CValenzuela\Payment_ticket');
    }
}
