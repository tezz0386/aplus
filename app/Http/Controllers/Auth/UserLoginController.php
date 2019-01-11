<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\ParentCategory;
class UserLoginController extends Controller
{
    //
     public function getLogin(){
        $parents=ParentCategory::with('childs')->get();
        if(Auth::check()){
        	return redirect()->route('/');
        }
      	return view('pages.login', ['parents'=>$parents]);
      // $request->session()->forget('signUp');
    }
    public function postLogin(Request $request){
    	 $this->validate($request,[
                 'email'=>'required|email',
                 'password'=>'required'
       ]);
       if(Auth::attempt(['email'=>$request->get('email'), 'password'=>$request->get('password')])){
        $request->session()->put('auth', 'Authorized');
        return redirect()->route('/');
       }else{
          return back()->withInput()->with('error', 'password or user name not valied');
       }
    } 
    public function cartLogin(Request $request){
      if(!Session::has('auth')){
        if(Auth::attempt(['email'=>$request->get('email'), 'password'=>$request->get('password')])){
          $request->session()->put('auth', 'Authorized');
             return back()->with('sucess', 'Authorizede');
         }else{
            return back()->withInput()->with('error', 'password or user name not valied');
         }
       }
       return back();
     }
    public function logout(){
      Auth::logout();
      request()->session()->forget('auth');
      return redirect()->route('/');
    }


}
