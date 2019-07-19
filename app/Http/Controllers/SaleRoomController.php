<?php

namespace CValenzuela\Http\Controllers;

use CValenzuela;
use Illuminate\Http\Request;

class SaleRoomController extends Controller
{
    //SHOW

    public function index(){
        $tables = CValenzuela\Table::all();
        return view('saleroom.index',compact('tables'));
    }

    public function showTable($id){
        $tables = CValenzuela\Table::all();
        $cTable = CValenzuela\Table::findOrFail($id);
        $ticket = $cTable->tickets()->where('active',1)->first();
        $products = CValenzuela\Product::all();
        $total = 0;
        if($ticket != null){
            foreach($ticket->products as $product){
                $total = $total + $product->pivot->total;
            }
        }
        return view('saleroom.table',compact('tables','cTable','ticket','products','total'));
    }
}
