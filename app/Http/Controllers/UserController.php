<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\sendVerification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Order;
use Session;
use Auth;
use App\ParentCategory;
use App\Category;
class UserController extends Controller
{
    //
    // public function getLogin(Request $request){
    //   // return view('pages.login');
    //   $request->session()->forget('signUp');
    // }
    public function getSignup(){
      $parents=ParentCategory::with('childs')->get();
    	return view('pages.signup', ['parents'=>$parents]);
    }
    public function getProfile(){
      return 'now creating the get profile';
    }
    public function postSignup(Request $request){

    	// $this->validate($request,[
     //          'email'=>'required|email',
     //          'password'=>'required',
     //          'password1'=>'required',
     //          'address'=>'required',
     //          'contact'=>'required|integer|min:9|max:12'
    	// ]);


    	$pass1 =$request->get('password');
    	$pass2 =$request->get('password1');
    	if($pass1==$pass2){
           $userSignup = new User();
    	     if(Session::has('userSignup')){
                $userSignup=Session::get('userSignup');
    	    }else{
    		     $userSignup->email=$request->get('email');
    		     $userSignup->password1=$pass1;
    		     $userSignup->address=$request->get('address');
    		     $userSignup->contact=$request->get('contact');
    		     $request->session()->put('userSignup', $userSignup);
    	   }
             $verificationCode =str_random(8);
             $goto='Click Here For Verify';
             $subject='Account Verification Code:';
             $url='/user/verification/';
             $footer='Thanks for Joining us for online shoping';
             $request->session()->put('verification', $verificationCode);
             $user=$request->session()->get('userSignup');
             Notification::send($user, new sendVerification($subject, $verificationCode, $url, $goto, $footer));
             return view('pages.verification');
         }else {
            return back()->withInput()->with('error', 'could not be signuped try again later');
         }

       }


       public function getVerification($verification=null){
          $parents=ParentCategory::with('childs')->get();
       	  return view('pages.verification')->with(['verification'=>$verification, 'parents'=>$parents]);

       }

        public function postVerification(Request $request){
        	$verificationCode=$request->session()->get('verification');
        	$verification=$request->get('verification');
        	if($verificationCode==$verification){
                   $user = new User([
                           'email'=>$request->session()->get('userSignup')->email,
                           'password' => Hash::make($request->session()->get('userSignup')->password1),
                           'address'=>$request->session()->get('userSignup')->address,
                           'contact'=>$request->session()->get('userSignup')->contact
                   ]);
                   if($user->save()){
                   	  $request->session()->forget('verification');
                   	  $request->session()->forget('userSignup');
                   	  return redirect()->route('/')->with('sucess', 'Signup sucessfully');
                   }else{
                       return back()->withInput()->with('error', 'something is goint wrong');
                   }
        	}else{
                   return back()->withInput()->with('error','Verification could not be matched');
        	}
       }
       
       public function getTransaction(){
         $orders=Order::with('user')->where('user_id', Auth::user()->id)->orderBy('created_at','dec')->get();
         $orders->transform( function($order, $key){
          $order->cart=unserialize($order->cart);
           return $order;
        });
        // return $orders;
         $parents=ParentCategory::with('childs')->get();
         return view('user.transaction', ['parents'=>$parents, 'orders'=>$orders]);
       }
}
