<?php

namespace CValenzuela\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Session;
class AppController extends Controller
{
    public function index(){
        return view('home.index');
    }

    public function switchLang($lang){
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return back()->withInput();
    }
    
}
