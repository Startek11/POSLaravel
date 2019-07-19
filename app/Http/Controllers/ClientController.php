<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use CValenzuela;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ClientController extends Controller
{
    //CRUD Methods

    //INDEX SHOW ALL [INDEX]
    public function index(){
        $clients = CValenzuela\Client::all();
        return view('client.index', compact('clients'));
    }

    //CREATE CLIENT [FORM]
    public function create(){
        return view('client.create');
    }
    //STORE CLIENT [SAVE]
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'between:3,40|required',
            'lastname' => 'between:3,40|required',
            'document' => 'numeric|digits:8|required|unique:clients',
            'address' => 'between:5,50',
            'phone' => 'numeric|digits:9'
        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $client = new CValenzuela\Client;
        $client->name = $request->name;
        $client->lastName = $request->lastname;
        $client->document = $request->document;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return redirect()
                ->route('client.index')
                ->with('info',trans('client.index.created'));
    }
    //EDIT CLIENT [FORM]
    public function edit($id){
        try {
            $client = CValenzuela\Client::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('client.edit',compact('client'));
    }
    //UPDATE CLIENT [SAVE]
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'between:3,40|required',
            'lastname' => 'between:3,40|required',
            'document' => [
                'numeric',
                'digits:8',
                'required',
                Rule::unique('clients')->ignore($id),
            ],
            'address' => 'between:5,50',
            'phone' => 'numeric|digits:9'
        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $client = CValenzuela\Client::findOrFail($id);
        $client->name = $request->name;
        $client->lastName = $request->lastname;
        $client->document = $request->document;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return redirect()
                ->route('client.index')
                ->with('info',trans('client.index.updated'));
    }
    //SHOW CLIENT [READ]
    public function show($id){
        try {
            $client = CValenzuela\Client::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('client.show',compact('client'));
    }
    //DELETE CLIENT [DELETE]
    public function delete($id){
        try {
            $client = CValenzuela\Client::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        $client->delete();
        return back()->with('info',__('client.index.delete'));
    }


    //INSTANT SEARCH CLIENTS
    function instaSearch(Request $request){

     if($request->ajax()){
            $output = '';
            $query = $request->get('query');

            if($query != ''){
                $data = CValenzuela\Client::where('document','like','%'.$query.'%')
                                                ->orWhere('name','like','%'.$query.'%')
                                                ->orWhere('lastName','like','%'.$query.'%')
                                                ->get();
            }else{
                $data = CValenzuela\Client::all();
            }
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $client){
                    $output .= '
                    <tr>
                        <th scope="row">'.$client->document.'</th>
                        <td><a href="'.route('client.show',['id' => $client->id]).'">'.$client->name.' '.$client->lastName.'</a></td>
                        <td class="d-none d-md-table-cell">'.$client->created_at.'</td>
                        <td class="d-none d-md-table-cell">'.$client->updated_at.'</td>
                        <td class="text-center">
                            <a href="'. route('client.edit',['id' => $client->id]) .'" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                            <form action="'.route('client.delete',['id' => $client->id]).'" method="POST" class="d-inline-block">
                                '. csrf_field() .'
                                '. method_field('DELETE') .'
                                <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm(\''.trans('client.sure').'\')">
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
                    <td align="center" colspan="5">'.trans('client.noitem').'</td>
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
