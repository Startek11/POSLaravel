<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use CValenzuela;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class SupplyController extends Controller
{
    //CRUD METHODS
    //INDEX
    public function index(){
        $supplies = CValenzuela\Supply::all();
        return view('supply.index',compact('supplies'));
    }
    //CREATE
    public function create(){
        $providers = CValenzuela\Provider::all();
        return view('supply.create',compact('providers'));
    }
    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|between:3,30',
            'code' => 'required|between:3,6|unique:supplies',
            'description' => 'between:3,40',
            'stock' => 'numeric',
            'unitPrice' => 'required|numeric'
        ]);

        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        $provider = CValenzuela\Provider::findOrFail($request->providerID);

        $supply = new CValenzuela\Supply;
        $supply->name = $request->name;
        $supply->code = $request->code;
        $supply->description = $request->description;
        $supply->stock = $request->stock;
        $supply->unitPrice = $request->unitPrice;
        if($request->stock > 0){
            $supply->available = true;
        }else{
            $supply->available = false;
        }
        $supply->provider()->associate($provider);

        $supply->save();

        return redirect()
            ->route('supply.index')
            ->with('info',trans('supply.index.created'));
    }
    //EDIT
    public function edit($id){
        try {
            $supply = CValenzuela\Supply::findOrFail($id);
            $providers = CValenzuela\Provider::all();
        } catch (Exception $e) {
            return view('errors.404');
        }

        return view('supply.edit',compact('supply','providers'));
    }
    //UPDATE
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|between:3,30',
            'code' => [
                'required',
                'between:3,6',
                Rule::unique('supplies')->ignore($id)
            ],
            'description' => 'between:3,40',
            'stock' => 'numeric',
            'unitPrice' => 'required|numeric'
        ]);

        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        $provider = CValenzuela\Provider::findOrFail($request->providerID);

        $supply = CValenzuela\Supply::findOrFail($id);
        $supply->name = $request->name;
        $supply->code = $request->code;
        $supply->description = $request->description;
        $supply->stock = $request->stock;
        $supply->unitPrice = $request->unitPrice;

        $supply->provider()->associate($provider);

        if($request->stock > 0){
            $supply->available = true;
        }else{
            $supply->available = false;
        }

        $supply->save();

        return redirect()
            ->route('supply.index')
            ->with('info',trans('supply.index.updated'));
    }
    //SHOW
    public function show($id){
        try {
            $supply = CValenzuela\Supply::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('supply.show',compact('supply'));
    }

    //DELETE
    public function delete($id){
        try {
            $supply = CValenzuela\Supply::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        $supply->delete();

        return redirect()
                ->route('supply.index')
                ->with('info',trans('supply.index.delete'));
    }

    //LIVE SEARCH METHOD
    function instaSearch(Request $request){

        if($request->ajax()){
               $output = '';
               $query = $request->get('query');
   
               if($query != ''){
                   $data = CValenzuela\Supply::where('code','like','%'.$query.'%')
                                                   ->orWhere('name','like','%'.$query.'%')
                                                   ->get();
               }else{
                   $data = CValenzuela\Supply::all();
               }
               $total_row = $data->count();
               if($total_row > 0){
                   foreach($data as $supply){
                       $output .= '
                       <tr>
                           <th scope="row">'.$supply->code.'</th>
                           <td><a href="'.route('supply.show',['id' => $supply->id]).'">'.$supply->name.'</a></td>
                           <td class="d-table-cell">s/'.number_format($supply->unitPrice,2,'.',' ').'</td>
                           <td class="d-table-cell">'.$supply->stock.'</td>
                           <td class="text-right">
                               <a href="'. route('supply.edit',['id' => $supply->id]) .'" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                               <form action="'.route('supply.delete',['id' => $supply->id]).'" method="POST" class="d-inline-block">
                                   '. csrf_field() .'
                                   '. method_field('DELETE') .'
                                   <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm(\''.trans('supply.sure').'\')">
                                       <i class="fas fa-trash"></i>
                                   </button>
                               </form>
                           </td>
                       </tr>
                       ';
                   }
               }else{
                   $output = '
                   <tr>
                       <td align="center" colspan="5">'.trans('supply.noitem').'</td>
                   </tr>
                   ';
               }
               $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
               );
   
               echo json_encode($data);
           }
        }
}
