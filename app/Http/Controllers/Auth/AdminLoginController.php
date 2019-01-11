<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
class AdminLoginController extends Controller
{
    //
    public function __construct(){
    	 // $this->middleware('guest:admin');
    }
    public function getLogin(){
        if(Auth::guard('admin')){
            return redirect()->route('dashboard');
        }
    	return view('admin.login');
    }
    public function postLogin(Request $request){
         $this->validate($request,[
                 'email'=>'email|required',
                 'password'=>'required'
         ]);
         if(Auth::guard('admin')->attempt(['email'=>$request->get('email'), 'password'=>$request->get('password')])){
            $request->session()->put('admin', $request->get('email'));
         	return view('admin.dashboard');
         }else{
         	return back()->withInput();
         }
         return back()->withInput();
    }
     public function getLogout(){
     	// return 'hello';
        if(Auth::guard('admin')->check()){
            request()->session()->forget('admin');
            Auth::guard('admin')->logout();
        }
    	 return view('admin.login');
    }
}
