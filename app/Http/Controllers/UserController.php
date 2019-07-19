<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use CValenzuela;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //CRUD METHODS
    //INDEX
    public function index(){
        $users = CValenzuela\User::all();
        return view('user.index',compact('users'));
    }

    //CREATE
    public function create(){
        return view('user.create');
    }

    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'names' => ['required', 'string', 'max:255'],
            'file'  => 'image',
            'lastnames' => ['required','string','max:255'],
            'username' => ['required','between:8,20','unique:users'],
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
        $nameFile = "default.png";
        if($request->file != null){
            $file = $request->file;
            $nameFile = $file->getClientOriginalName();
            \Storage::disk('local')->put($nameFile,  \File::get($file));
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
        $user->file = $nameFile;
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
            $user = CValenzuela\User::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('user.edit',compact('user'));
    }

    //UPDATE DATES
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'names' => ['required', 'string', 'max:255'],
            'file'  => 'image',
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
        $nameFile = $user->file;
        if($request->file != null){
            $file = $request->file;
            $nameFile = $file->getClientOriginalName();
            \Storage::disk('local')->put($nameFile,  \File::get($file));
        }

        $user->names = $request->names;
        $user->lastnames = $request->lastnames;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->birthday = $birthday->format('Y-m-d');
        $user->file = $nameFile;
        $user->document = $request->document;
        $user->email = $request->email;
        
        $user->save();

        return redirect()
                ->route('user.index')
                ->with('info',trans('user.updated'));
    }
    //EDIT PASSWORD
    public function editPassword($id){
        try {
            $user = CValenzuela\User::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('user.editpassword',compact('user'));
    }
    //UPDATE PASSWORD
    public function updatePassword(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator);
        }
        $user = CValenzuela\User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()
                ->route('user.index')
                ->with('info',trans('user.passupdated'));
    }
    //SHOW
    public function show($id){
        try {
            $user = CValenzuela\User::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('user.show',compact('user'));
    }
    //DISABLE USER
    public function disableUser($id){
        try {
            $user = CValenzuela\User::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }

        $user->active = false;
        $user->save();

        return back()
                ->with('info',trans('user.disabled'));
    }
    public function enableUser($id){
        try {
            $user = CValenzuela\User::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }

        $user->active = true;
        $user->save();

        return back()
                ->with('info',trans('user.disabled'));
    }

    public function points($id){
        try {
            $user = CValenzuela\User::findOrFail($id);
        } catch (Exception $e) {
            return view('errors.404');
        }
        return view('user.points',compact('user'));
    }

    public function setPoints(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'cant' => 'required|integer|min:1',
            'reason' => 'required|min:5|max:30',
        ]);

        if($validator->fails()){
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $user = CValenzuela\User::findOrFail($id);

        $behavior = new CValenzuela\Behavior;
        $behavior->cant = $request->cant;
        $behavior->reason = $request->reason;
        $behavior->user()->associate($user);
        $behavior->type = $request->option;
        $behavior->save();
        if($request->option == 'ADD'){
            $user->points = ($user->points) + ($request->cant);
            $message = trans('user.points.added');
        }else{
            $user->points = ($user->points) - ($request->cant);
            $message = trans('user.points.removed');
        }


        $user->save();


        return redirect()
                ->route('user.index')
                ->with('info',$message);

    }
    //LIVE SEARCH FUNCTION
    function instaSearch(Request $request){

        if($request->ajax()){
               $output = '';
               $query = $request->get('query');
   
               if($query != ''){
                   $data = CValenzuela\User::where('document','like','%'.$query.'%')
                                                   ->orWhere('names','like','%'.$query.'%')
                                                   ->orWhere('lastnames','like','%'.$query.'%')
                                                   ->orWhere('username','like','%'.$query.'%')
                                                   ->get();
               }else{
                   $data = CValenzuela\User::all();
               }
               $total_row = $data->count();
               if($total_row > 0){
                   foreach($data as $user){
                       if($user->active){
                           $htmlstate = '<i class="fas fa-circle text-success"></i> ';
                       }else{
                            $htmlstate = '<i class="fas fa-circle text-danger"></i> ';
                       }
                       $output .= '
                       <tr>
                           <th scope="row">'.$user->document.'</th>
                           <td><a href="'.route('user.show',['id' => $user->id]).'">'.$htmlstate.$user->names.' '.$user->lastnames.'</a></td>
                           <td class="d-none d-md-table-cell">'.$user->phone.'</td>
                           <td class="d-none d-md-table-cell text-center font-weight-bold">'.$user->points.'</td>
                           <td class="text-center">
                               <a href="'. route('user.edit',['id' => $user->id]) .'" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                               <a href="'. route('user.editpass',['id' => $user->id]) .'" class="btn btn-info text-white btn-sm" role="button"><i class="fas fa-asterisk"></i></a>
                               <a href="'. route('user.points',['id' => $user->id]) .'" class="btn btn-warning text-white btn-sm" role="button"><i class="fab fa-product-hunt"></i></a>
                           </td>
                       </tr>
                       ';
                   }
               }else{
                   $output = '
                   <tr>
                       <td align="center" colspan="5">'.trans('user.noitem').'</td>
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
