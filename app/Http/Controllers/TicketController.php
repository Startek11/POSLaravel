<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use CValenzuela;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class TicketController extends Controller
{
    public function show($code){
        $ticket = CValenzuela\Ticket::where('code','like',$code)->first();

        return view('ticket.show',compact('ticket'));
    }
    public function create($id){
        $ticket = new CValenzuela\Ticket;

        $tickets = CValenzuela\Ticket::all();
        $lastTicket = $tickets->last();
        if($lastTicket != null){
            $newCode = (int)substr($lastTicket->code,5);

            $newCode++;
        }else{
            $newCode= 1;
        }
        
        $ticket->code = 'TCK-'.str_pad($newCode, 5, "0", STR_PAD_LEFT);
        $ticket->table()->associate($id);
        $ticket->observation = "OBSERVACION BASICA";
        $ticket->save();
        
        return back();
    }

    public function delete($id){
        $ticket = CValenzuela\Ticket::findOrFail($id);

        $ticket->delete();

        return back();
    }
    public function addProduct($id,Request $request){
        $validator = Validator::make($request->all(),[
            'product' => 'required',
            'cant' => 'required|integer|min:1|max:10'
        ]);
        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        
        $ticket = CValenzuela\Ticket::findOrFail($id);
        $product = CValenzuela\Product::findOrFail($request->product);

        $total = $product->price*$request->cant;
        $currentProduct = $ticket->products()->where('product_id','=',$product->id)->first();
        if($currentProduct != null){
            $lastCant = $currentProduct->pivot->cant;
            $lastTotal = $currentProduct->pivot->total;
        }else{
            $lastCant = 0;
            $lastTotal = 0;
        }
        $ticket->products()->syncWithoutDetaching([$product->id => ['cant' => ($request->cant+$lastCant), 'total' => ($total+$lastTotal)]]);

        $ticket->save();

        return Redirect::to(URL::previous() . "#tableDetails");
    } 

    public function removeProduct($idTicket, $idProduct){
        $ticket = CValenzuela\Ticket::findOrFail($idTicket);

        $ticket->products()->detach($idProduct);

        $ticket->save();

        return Redirect::to(URL::previous() . "#tableDetails");
    }

    public function summary($id){
        $ticket = CValenzuela\Ticket::findOrFail($id);

        return view('saleroom.ticket-details',compact('ticket'));
    }
}
