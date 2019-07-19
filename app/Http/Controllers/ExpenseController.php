<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use CValenzuela;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    //CRUD METHODS
    //INDEX
    public function index(){
        $expenses = CValenzuela\Expense::all();
        return view('expense.index',compact('expenses'));
    }

    //CREATE
    public function create(){

        $users= CValenzuela\User::all();
        $supplies=CValenzuela\Supply::all();
        return view('expense.create', compact('users', 'supplies'));
    }

    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'description' => ['string', 'max:255'],
            'type' => ['required','string'],
            'supply_code' => ['required','between:8,20','unique:users'],
            'address' => ['max:50'],
            'phone' => ['numeric','digits:9','required'],
            'birthday' => ['date','required'],
            'document' => ['required','unique:users','digits:8','numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        $birthday = new DateTime($request->birthday);

        $user = new CValenzuela\User;

        $user->names = $request->names;
        $user->lastnames = $request->lastnames;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->birthday = $birthday->format('Y-m-d');
        $user->document = $request->document;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //SEND EMAIL
        $to_name = $request->names;
        $to_email = $request->email;

        Mail::send('emails.user.created',$request->all(),function($message) use($to_name,$to_email){
            $message->to($to_email, $to_name)
            ->subject(trans('user.mail.create.subject'));
            $message->from('cafevalenzuela145@gmail.com','Cafe Valenzuela');
        });

        return redirect()
                ->route('user.index')
                ->with('info',trans('user.created'));
    }

    //EDIT
    public function edit($id){
        try {
            $expense = CValenzuela\Expense::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('expense.edit',compact('expense'));
    }

    //UPDATE DATES
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'names' => ['required', 'string', 'max:255'],
            'lastnames' => ['required','string','max:255'],
            'username' => ['required','between:8,20',Rule::unique('users')->ignore($id)],
            'address' => ['max:50'],
            'phone' => ['numeric','digits:9','required'],
            'birthday' => ['date','required'],
            'document' => ['required',Rule::unique('users')->ignore($id),'digits:8','numeric'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);
        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        $birthday = new DateTime($request->birthday);

        $user = CValenzuela\User::findOrFail($id);

        $user->names = $request->names;
        $user->lastnames = $request->lastnames;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->birthday = $birthday->format('Y-m-d');
        $user->document = $request->document;
        $user->email = $request->email;
        
        $user->save();

        return redirect()
                ->route('user.index')
                ->with('info',trans('user.updated'));
    }

    //SHOW
    public function show($id){
        try {
            $expense = CValenzuela\Expense::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('expense.show',compact('expense'));
    }

    //LIVE SEARCH FUNCTION
    function instaSearch(Request $request){

        if($request->ajax()){
               $output = '';
               $query = $request->get('query');
   
               if($query != ''){
                   $data = CValenzuela\Expense::where('type','like','%'.$query.'%')
                                                   ->orWhere('supply_code','like','%'.$query.'%')
                                                   ->orWhere('user_code','like','%'.$query.'%')
                                                   ->orWhere('description','like','%'.$query.'%')
                                                   ->orWhere('total','=',$query)
                                                   ->orWhere('voucher_code','like','%'.$query.'%')
                                                   ->orWhere('cant','=',$query)
                                                   ->get();
               }else{
                   $data = CValenzuela\Expense::all();
               }
               $total_row = $data->count();
               if($total_row > 0){
                   foreach($data as $expense){
                       $output .= '
                       <tr>
                           <th scope="row">'.$expense->id.'</th>
                           <td><a href="'.route('expense.show',['id' => $expense->id]).'">'.$expense->description.'</a></td>
                          <td ">'.$expense->type.'</td>
                           <td ">'.$expense->total.'</td>
                           <td ">'.$expense->cant.'</td>
                           <td class="d-none d-md-table-cell">'.$expense->created_at.'</td>
                            
                       </tr>
                       ';
                   }
               }else{
                   $output = '
                   <tr>
                       <td align="center" colspan="5">'.trans('expense.noitem').'</td>
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
