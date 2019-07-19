<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use CValenzuela;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ProviderController extends Controller
{
     //CRUD Methods

    //INDEX SHOW ALL [INDEX]
    public function index(){
        $providers = CValenzuela\Provider::where('id','!=','1')->get();
        return view('provider.index', compact('providers'));
    }

    //CREATE CLIENT [FORM]
    public function create(){
        return view('provider.create');
    }
    //STORE CLIENT [SAVE]
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'between:3,40|required',
            'code' => 'required|between:3,6|unique:providers',
            'ruc' => 'numeric|digits:11|required|unique:providers',
            'address' => 'between:5,50',
            'phone' => 'numeric|digits:9'
        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $provider = new CValenzuela\Provider;
        $provider->name = $request->name;
        $provider->code = strtoupper($request->code);
        $provider->ruc = $request->ruc;
        $provider->address = $request->address;
        $provider->phone = $request->phone;
        $provider->save();

        return redirect()
                ->route('provider.index')
                ->with('info',trans('provider.index.created'));
    }
    //EDIT CLIENT [FORM]
    public function edit($id){
        try {
            $provider = CValenzuela\Provider::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('provider.edit',compact('provider'));
    }
    //UPDATE CLIENT [SAVE]
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'between:3,40|required',
            'code' => [
                'between:3,6',
                'required',
                Rule::unique('providers')->ignore($id),
            ],
            'ruc' => [
                'numeric',
                'digits:11',
                'required',
                Rule::unique('providers')->ignore($id),
            ],
            'address' => 'between:5,50',
            'phone' => 'numeric|digits:9'
        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $provider = CValenzuela\Provider::findOrFail($id);
        $provider->name = $request->name;
        $provider->code = strtoupper($request->code);
        $provider->ruc = $request->ruc;
        $provider->address = $request->address;
        $provider->phone = $request->phone;
        $provider->save();

        return redirect()
                ->route('provider.index')
                ->with('info',trans('provider.index.updated'));
    }
    //SHOW CLIENT [READ]
    public function show($id){
        try {
            $provider = CValenzuela\Provider::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('provider.show',compact('provider'));
    }
    //DELETE CLIENT [DELETE]
    public function delete($id){
        try {
            $provider = CValenzuela\Provider::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        $supplies = $provider->supplies;
        $provider->delete();
        foreach($supplies as $supply){
            $supply->provider()->associate(1);
            $supply->save();
        }
        return back()->with('info',__('provider.index.delete'));
    }


    //INSTANT SEARCH CLIENTS
    function instaSearch(Request $request){

     if($request->ajax()){
            $output = '';
            $query = $request->get('query');

            if($query != ''){
                $data = CValenzuela\Provider::where('ruc','like','%'.$query.'%')
                                                ->orWhere('name','like','%'.$query.'%')
                                                ->orWhere('code','like','%'.$query.'%')
                                                ->get();
            }else{
                $data = CValenzuela\Provider::where('id','!=','1')->get();
            }
            $total_row = $data->count();
            if($total_row >0){
                foreach($data as $provider){
                    if($provider->id != 1){
                        $output .= '
                        <tr>
                            <th scope="row">'.$provider->code.'</th>
                            <td><a href="'.route('provider.show',['id' => $provider->id]).'">'.$provider->ruc.'</a></td>
                            <td><a href="'.route('provider.show',['id' => $provider->id]).'">'.$provider->name.'</a></td>
                            <td class="d-none d-md-table-cell">'.$provider->created_at.'</td>
                            <td class="text-center">
                                <a href="'. route('provider.edit',['id' => $provider->id]) .'" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                                <form action="'.route('provider.delete',['id' => $provider->id]).'" method="POST" class="d-inline-block">
                                    '. csrf_field() .'
                                    '. method_field('DELETE') .'
                                    <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm(\''.trans('provider.sure').'\')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        ';
                    }else{
                        $output = '
                        <tr>
                            <td align="center" colspan="5">'.trans('provider.noitem').'</td>
                        </tr>
                        ';
                    }
                }
            }else{
                $output = '
                <tr>
                    <td align="center" colspan="5">'.trans('provider.noitem').'</td>
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
