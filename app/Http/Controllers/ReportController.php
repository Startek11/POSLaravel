<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use CValenzuela;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    //
    public function index(){
        $sales = CValenzuela\Sale::all();
        $total = 0;
        foreach($sales as $sale){
            $total += $sale->total;
        }
        return view('report.index', compact('total','sales'));
    }
    public function show($id){
        try {
            $provider = CValenzuela\Provider::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('provider.show',compact('provider'));
    }
    function instaSearch(Request $request){
        
        
        if($request->ajax()){
           $output = '';
           $query = $request->get('query');

           if($query != ''){
               $data = CValenzuela\Sale::where('code','like','%'.$query.'%')
                                               ->orWhere('subTotal','=',$query)
                                               ->orWhere('igv','=',$query)
                                               ->orWhere('total','=',$query)
                                               ->orWhere('payMethod','like','%'.$query.'%')
                                               ->get()
                                               ->sortByDesc('created_at');
           }else{
               $data = CValenzuela\Sale::all()->sortByDesc('created_at');
           }
           $total_row = $data->count();
           if($total_row >0){
               foreach($data as $sales){
               
                       $output .= '
                       <tr>
                           <th scope="row"><a href="'.route('sale.show',['id' => $sales->id]).'">'.$sales->code.'</a></th>
                           <td> <a href="'.route('sale.show',['id' => $sales->id]).'">'.$sales->ticket_code.'</a></td>
                           <td>S/'.number_format($sales->subTotal,2,'.',' ').'</td>
                           <td>S/'.number_format($sales->igv,2,'.',' ').'</td>
                           <td>S/'.number_format($sales->total,2,'.',' ').'</td>
                           <td>'.$sales->payMethod.'</td>
                            <td class="d-none d-md-table-cell">'.$sales->created_at.'</td>
                       </tr>
                       '; 
               }
           }else{
               $output = '
               <tr>
                   <td align="center" colspan="5">'.trans('product.noitem').'</td>
               </tr>
               ';
           }
           $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
           );
           return json_encode($data);
        }
    }
}
