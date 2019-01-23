<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    //
     public function __construct(){
    	// $this->middleware('auth:admin');
     }
     public function index(){
     	return view('admin.login');
     }
      public function dashBoard(){
      if(Auth::guard('admin')->check()){
     	return view('admin.dashboard');
     }else{
        return view('admin.login');
     }
    }

    public function getAccount(){
         if(Auth::guard('admin')->check()){
            return view('admin.account');
         }
        return view('admin.login');
    }
}
