<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Notifications\sendVerification;
use Illuminate\Http\Request;
use App\Order;
use Session;
use App\Cart;
use Auth;
use Illuminate\Support\Facades\DB;
class CheckoutController extends Controller
{
    //
    public function postCheckout(Request $request){
        //here most be implemet the sms to send
        $cart='';
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
        }
        $token=$request->get('stripeToken');
        \Stripe\Stripe::setApiKey("sk_test_w2K8er3AZqAAoBIh2eMPgD2F");
        $charge = \Stripe\Charge::create([
            'amount' => $cart->totalPrice,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);
        if($charge){
            $user=Auth::user();
            $order = new Order();
            $order->name=$request->get('name');
            $order->card_holder_name=$request->get('card_name');
            $order->address=$request->get('address');
            $order->cart=serialize($cart);
            $order->user_id=Auth::user()->id;
            if($order->save()){



                $goto='Click Here For Transaction show';
                $subject='Transaction sucess';
                $message="Your transaction has bee sucessfull Total price is RS: ".$cart->totalPrice;
                $url='user/shoping-cart/postcheckout/sucess';
                $footer='Thanks for Joining Ordering We will Deliver you as soon as possible';
                Notification::send($user, new sendVerification($subject, $message, $url, $goto, $footer));
                Session::forget('cart');
                return redirect()->route('/')->with('sucess', 'Sucessfully purchased');
            }
        }
        return back()->withInput()->with('error', 'Smething is going to wrong could not be purchase');
    }
    public function showForm(){
        // return view('pages.checkout');
    }
    public function postForm(Request $request){
        $token=$request->get('stripeToken');
        \Stripe\Stripe::setApiKey("sk_test_w2K8er3AZqAAoBIh2eMPgD2F");
        $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);
        dd('payment sucess');
    }
    public function postCheckoutCash(Request $request){
           $this->validate($request, [
              'name'=>'required|string',
              'contact'=>'required',
              'address'=>'required|string'
           ]);
          $oldCart=$request->session()->get('cart');
          $cart=new Cart($oldCart);
          $id=Auth::user()->id;
          $order_cart = new Order();
          $order_cart->name=$request->get('name');
          $order_cart->address=$request->get('address');
          $order_cart->contact=$request->get('contact');
          $order_cart->user_id=$id;
          $order_cart->cart=serialize($cart);
          $order_id=Order::select('id')->max('id');
          foreach($cart->items as $item){
            DB::table('calculations')->insert(
                ['order_id' => $order_id+1, 'user_id'=>Auth::user()->id, 'p_id'=>$item['item']['id'], 'qty'=>$item['qty']]
            );
           }
          if($order_cart->save()){
              $request->session()->forget('cart');
              return redirect()->route('/')->with('sucess', 'Sucessfully Ordered');
          }
        //   $request->session()->put('order_cart', $order_cart);
    }
}
