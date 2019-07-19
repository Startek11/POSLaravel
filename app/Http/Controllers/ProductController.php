<?php

namespace CValenzuela\Http\Controllers;
use CValenzuela;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //CRUD METHODS

    //INDEX
    public function index(){
        $products = CValenzuela\Product::all();
        $types = CValenzuela\Type_Product::all();
        return view('product.index',compact('products','types'));
    }

    //CREATE
    public function create(){
        try {
            $types = CValenzuela\Type_Product::all();
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('product.create',compact('types'));
    }

    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'description' => 'required|between:3,20',
            'code' => 'required|unique:products|between:3,6',
            'price' => 'numeric|required|min:0',
        ]);

        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $product = new CValenzuela\Product;
        $product->code =strtoupper($request->code);
        $product->description = $request->description;
        $product->price = $request->price;

        $product->type()->associate($request->type);

        $product->save();

        return redirect()
                ->route('product.index')
                ->with('info',trans('product.index.created'));
    }

    //EDIT
    public function edit($id){
        try {
            $product = CValenzuela\Product::findOrFail($id);
            $types = CValenzuela\Type_Product::all();
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('product.edit',compact('product','types'));
    }

    //UPDATE
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'description' => 'required|between:3,20',
            'price' => 'numeric|required|min:0',
            'code' => [
                'between:3,6',
                'required',
                Rule::unique('products')->ignore($id),
            ]
        ]);
        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $type = CValenzuela\Type_Product::findOrFail($request->type);
        $product = CValenzuela\Product::findOrFail($id);

        $product->code = strtoupper($request->code);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->type()->associate($type);

        $product->save();

        return redirect()
                ->route('product.index')
                ->with('info',trans('product.index.updated'));
    }

    public function delete($id){
        try {
            $product = CValenzuela\Product::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }

        try {
            $product->delete();
        } catch (Exception $e) {
            return back()->with('info',trans('product.index.cannotDelete'));
        }

        return back()
                ->with('info',trans('product.index.deleted'));
    }

    public function show($id){
        try {
            $product = CValenzuela\Product::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('product.show',compact('product'));
    }
   //INSTANT SEARCH CLIENTS
   function instaSearch(Request $request){

    if($request->ajax()){
           $output = '';
           $query = $request->get('query');

           if($query != ''){
               $data = CValenzuela\Product::where('description','like','%'.$query.'%')
                                               ->orWhere('code','like','%'.$query.'%')
                                               ->orWhere('price','=',$query)
                                               ->orWhereHas('type', function ($que) use($query){
                                                    $que->where('type', 'like', '%'.$query.'%');
                                                })->get();
           }else{
               $data = CValenzuela\Product::all();
           }
           $total_row = $data->count();
           if($total_row >0){
               foreach($data as $product){
                $status="<i class='fas fa-circle text-danger'></i>";
                      if($product->available){
                          $status="<i class='fas fa-circle text-success'></i>";
                      }
                       $output .= '
                       <tr>
                           <th scope="row">'.$product->code.'</th>
                           <td><a href="'.route('product.show',['id' => $product->id]).'">'.$status.' '.$product->description.' </a></td>
                           <td class="d-table-cell">s/'.number_format($product->price,2,'.',' ').'</td>
                           <td class="d-none d-md-table-cell">'.($product->type)->type.'</td>
                           <td class="text-center">
                               <a href="'. route('product.edit',['id' => $product->id]) .'" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                               <form action="'.route('product.delete',['id' => $product->id]).'" method="POST" class="d-inline-block">
                                   '. csrf_field() .'
                                   '. method_field('DELETE') .'
                                   <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm(\''.trans('product.sure').'\')">
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
