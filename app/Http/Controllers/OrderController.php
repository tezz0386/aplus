<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Notifications\sendVerification;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Transaction;
class OrderController extends Controller
{
    //
    public function index(){
        $orders=Order::with('user')->orderBy('created_at','dec')->paginate(8);
        return view('admin.order.orderList', ['orders'=>$orders]);

    }
    public function orderDetails($id){
             $orders=Order::with('user')->where('id', $id)->where('trash', 'off')->orderBy('created_at','dec')->get();
             $orders->transform( function($order, $key){
                $order->cart=unserialize($order->cart);
                 return $order;
              });
     if(count($orders)>0){
         return view('admin.order.orderDetails', ['orders'=>$orders]);
     }else{
         return redirect()->route('admin.order')->with('error', 'Could not be view please check on Trashed Category List');
     }
 }
    public function orderDeliver($id){
        $totalIncome='';
        $ord=Order::find($id);
        $orders=Order::where('id', $id)->get();
             $orders->transform( function($order, $key){
                $order->cart=unserialize($order->cart);
                 return $order;
              });
        foreach($orders as $order){
           $totalIncome= $order->cart->totalPrice;
        }
        $transaction =new Transaction([
            'order_id'=>$id,
            'total_income'=>$totalIncome,
        ]);
        $ord->status='on';
        if($ord->save() && $transaction->save()){
            return back()->with('sucess', 'Transaction Sucessfully');
        }else{
            return back()->with('sucess', 'Transaction Unsucessfull');
        }
  }

  public function orderTrash($id){
      $order=Order::find($id);
      $user_id=$order->user_id;
      $user=USer::find($user_id);
      $subject='';
      $message='';
      $goto='';
      $url='';
    //   return $orders->user->email;
      if($order->trash=='on'){
         $trash='off';
         $subject='Congraitulation !! Your order have been Recover';
         $message ='Now You can again purchase your previous item';
         $url='/user/profile/transaction/recover';
         $footer='Thank You for your important time';
         $goto='Click To again purchase ';
      }else{
        $trash='on';
        $subject='Sorry !! Your order have been trashed';
        $message ='We Could not provide you that item you have ordered because we have some unexpected problem so sorry Your Balance will be recover within 5 minutes';
        $url='/user/profile/transaction/trash';
        $footer='Thank You for your important time';
        $goto='Click To show your trashed category';
      }
      $order->trash=$trash;
      if($order->save()){
          Notification::send($user, new sendVerification($subject, $message, $url, $goto, $footer));
          return back();
      }else{
          return back()->with('error', 'something is going wrong could not be trashed');
      }
  }


  public function orderTrashNow($id){
    $order=Order::find($id);
    $user_id=$order->user_id;
    $user=USer::find($user_id);
      $trash='on';
      $subject='Sorry !! Your order have been trashed';
      $message ='We Could not provide you that item you have ordered because we have some unexpected problem so sorry Your Balance will be recover within 5 minutes';
      $url='/user/profile/transaction/trash';
      $footer='Thank You for your important time';
      $goto='Click To show your trashed category';
    $order->trash='on';
    if($order->save()){
        Notification::send($user, new sendVerification($subject, $message, $url, $goto, $footer));
        return redirect()->route('admin.order');
    }else{
        return back()->with('error', 'something is going wrong could not be trashed');
    }
   }
   public function orderTrashView(){
     $orders=Order::where('trash', 'on')->orderBy('created_at','dec')->paginate(8);
     return view('admin.order.trashOrder', ['orders'=>$orders]);
   }

}
