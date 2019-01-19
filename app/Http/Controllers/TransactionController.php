<?php

namespace App\Http\Controllers;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use Auth;
class TransactionController extends Controller
{
   public function index()
    {
        if(Auth::guard('admin')->check()){
        // $transactions=Transaction::orderBy('created_at', 'dec')->paginate(8);
        $transactions=Transaction::with('order')->orderBy('created_at', 'dec')->paginate(8);
        $totalQty=Transaction::sum('total_qty');
        $totalIncome=Transaction::sum('total_income');
        return view('admin.transaction.index', ['transactions'=>$transactions, 'totalQty'=>$totalQty, 'totalIncome'=>$totalIncome]);
        // return $transactions;
        }else{
            return redirect()->route('admin.login');
        }
    }
    public function viewDetails($id){
        if(Auth::guard('admin')->check()){
            $transaction =Transaction::find($id);
            $orders=Order::where('id', $transaction->order_id)->get();
             $orders->transform( function($order, $key){
                $order->cart=unserialize($order->cart);
                 return $order;
              });
            //   return $orders;
            return view('admin.transaction.transaction-details', ['orders'=>$orders]);
        }
        else{
            return redirect()->route('admin.login');
        }
    }
}
