<?php

namespace CValenzuela\Http\Controllers;

use CValenzuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeProductController extends Controller
{
    //CRUD METHODS CREATE AND REMOVE
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required|unique:type_product|max:20'
        ]);
        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        $type = new CValenzuela\Type_Product;
        $type->type = strtoupper($request->type);
        $type->save();
        return back()
                ->with('info',trans('product.type.created'));
    }

    public function delete($id){
        if($id == 1) {return back()->with('info',trans('product.type.cannot'));}
        try {
            $type = CValenzuela\Type_Product::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        $products = $type->products;

        $type->delete();
        foreach($products as $product){
            $product->type_id = 1;
            $product->save();
        }
        
        return back()
                ->with('info',trans('product.type.delete'));
    }
}
