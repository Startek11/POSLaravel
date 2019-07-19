<?php

namespace CValenzuela\Http\Controllers\Auth;

use CValenzuela\User;
use CValenzuela\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DateTime;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'names' => ['required', 'string', 'max:255'],
            'lastnames' => ['required','string','max:255'],
            'username' => ['required','between:8,20','unique:users'],
            'address' => ['max:50'],
            'phone' => ['numeric','digits:9','required'],
            'birthday' => ['date','required'],
            'document' => ['required','unique:users','digits:8','numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \CValenzuela\User
     */
    protected function create(array $data)
    {
        $birthday = new DateTime($data['birthday']);

        return User::create([
            'names' => $data['names'],
            'email' => $data['email'],
            'lastnames' => $data['lastnames'],
            'username' => $data['username'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'birthday' => $birthday->format('Y-m-d'),
            'document' => $data['document'],
            'points' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }
    public function showRegistrationForm(){
        return view('user.register');
    }
    
}

