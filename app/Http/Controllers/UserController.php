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
    public function getSignup(){
      if(!Auth::check()){
        $parents=ParentCategory::with('childs')->get();
        return view('pages.signup', ['parents'=>$parents]);
      }
      return back()->with('sucess', 'You have already an account');
    }
    public function getProfile(){
      return 'now creating the get profile';
    }
    public function postSignup(Request $request){

    	$this->validate($request,[
              'email'=>'required|email|unique:users',
              'password'=>'required',
              'password1'=>'required',
              'address'=>'required',
    	]);
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
          if(!Auth::check()){
            $parents=ParentCategory::with('childs')->get();
            return view('pages.verification')->with(['verification'=>$verification, 'parents'=>$parents]);
          }
          return back()->with('sucess', 'You could not get this section');
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
                      Auth::login($user);
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
         $parents=ParentCategory::with('childs')->get();
         return view('user.transaction', ['parents'=>$parents, 'orders'=>$orders]);
       }
       public function getForget(){
         if(!Auth::check()){
          $parents=ParentCategory::with('childs')->get();
          return view('pages.forget', ['parents'=>$parents]);
         }
         return back()->with('sucess', 'Access denied for this section');
       }
       public function postForget(Request $request){
         $user=User::where('email', $request->get('email'))->get();
         $id='';
         foreach($user as $us){
           $id=$us->id;
         }
         if(count($user)>0){
          $request->session()->put('id', $id);
          $verificationCode =str_random(8);
          $goto='Click Here For Reset';
          $subject='Account Verification Code:';
          $url='/user/password/';
          $footer='Thanks for Joining us for online shoping';
          $request->session()->put('verification', $verificationCode);
          Notification::send($user, new sendVerification($subject, $verificationCode, $url, $goto, $footer));
          return view('pages.reset');
         }else{
           return back()->with('error', 'The Email has not ben exist please fill correct email');
         }
      }

      public function getReset($verification=null){
        if(!Auth::check()){
          $parents=ParentCategory::with('childs')->get();
          return view('pages.reset', ['parents'=>$parents, 'verification'=>$verification]);
        }
        return back()->with('sucess', 'Access denied for this section');
      }

      public function postReset(Request $request){
        if($request->session()->get('verification')==$request->get('verification')){
         $id=$request->session()->get('id');
         $user=User::find($id);
         $user->password= Hash::make($request->get('password'));
         if($user->save()){
          Auth::login($user);
          Session::forget('id');
          Session::forget('verification');
          return redirect()->route('/')->with('sucess', 'sucessfully password reset');
         }else{
           return back()->with('error', 'could not be reste');
         }
        }else{
          return  back()->with('error', 'verification code doesnot matched');
        }
      }
      public function resendAgainVerification(Request $request){
             $verificationCode =str_random(8);
             $goto='Click Here For Verify';
             $subject='Account Verification Code:';
             $url='/user/verification/';
             $footer='Thanks for Joining us for online shoping';
             $request->session()->put('verification', $verificationCode);
             $user=$request->session()->get('userSignup');
             Notification::send($user, new sendVerification($subject, $verificationCode, $url, $goto, $footer));
             return view('pages.verification');
      }
}
