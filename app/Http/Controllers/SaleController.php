<?php

namespace CValenzuela\Http\Controllers;

use CValenzuela;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function show($id){
        try {
            $sale = CValenzuela\Sale::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        $ticket = CValenzuela\Ticket::where('code','like',$sale->ticket_code)->first();
        $pTicket = CValenzuela\Payment_ticket::where('sale_code','like',$sale->code)->first();

        return view('sale.show',compact('sale','ticket','pTicket'));

    }
    public function makeSale($id, Request $request){
        $ticket = CValenzuela\Ticket::findOrFail($id);
        $total = 0;
        $moneyCash = 0;
        $moneyCard = 0;
        foreach($ticket->products as $product){
            $total += $product->pivot->total;
        }

        if($request->payMethod == 'CASH'){
            $rules = ['cash' => 'required|numeric|integer|min:'.$total,
                        'document' => 'digits:8|numeric'];
            $moneyCash = $total;
            $moneyCard = 0;
        }
        if($request->payMethod == 'CARD'){
            $rules = ['cash' => 'numeric',
                        'document' => 'digits:8|numeric'];
            $moneyCard = $total;
            $moneyCash = 0;
        }
        if($request->payMethod == 'BOTH'){
            $rules = ['cash' => 'numeric|integer|min:0|max:'.$total,
                        'document' => 'digits:8|numeric'];
            $moneyCash = $request->cash;
            $moneyCard = $total - $request->cash;
        }

        $this->validate($request,$rules);
        $document = "00000000";
        $name = "GENERAL";
        if($request->document != null){
            $document = $request->document;
            $client = CValenzuela\Client::where('document','like',$request->document)->first();
            if($client != null){
                $name = $client->name;
            }
        }
        $sales = CValenzuela\Sale::all();
        $lastSale = $sales->last();
        if($lastSale != null){
            $newCode = (int)substr($lastSale->code,5);

            $newCode++;
        }else{
            $newCode= 1;
        }

        $igv = $total*0.18;
        $subtotal = $total-$igv;
        $salecode = 'SLE-'.str_pad($newCode, 5, "0", STR_PAD_LEFT);
        $sale = new CValenzuela\Sale;

        $sale->code = $salecode;
        $sale->ticket_code = $ticket->code;
        $sale->subTotal = $subtotal;
        $sale->igv = $igv;
        $sale->total = $total;
        $sale->moneyCash = $moneyCash;
        $sale->moneyCard = $moneyCard;
        $sale->payMethod = $request->payMethod;

        $sale->save();

        //CREANDO LA BOLETA DE VENTA

        $pTickets = CValenzuela\Payment_ticket::all();
        $lastpTicket = $pTickets->last();
        if($lastpTicket != null){
            $newCode = (int)substr($lastpTicket->code,5);

            $newCode++;
        }else{
            $newCode= 1;
        }
        $lSale = CValenzuela\Sale::where('code','like',$salecode)->first();
        $pTicket = new CValenzuela\Payment_ticket;
        $pTicket->sale_code = $salecode;
        $pTicket->code = 'PTK-'.str_pad($newCode, 5, "0", STR_PAD_LEFT);
        $pTicket->client_document = $document;
        $pTicket->client_name = $name;

        $pTicket->save();

        $ticket->active = false;
        $ticket->status = true;

        $ticket->save();

        return back()
                ->with('info',__('saleroom.salesuccess'));
    }
}
