<?php

namespace App\Http\Controllers;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

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
    public function todayTrasaction(){
        if(Auth::guard('admin')->check()){
            $totalQty=Transaction::whereDate('created_at', Carbon::today())->sum('total_qty');
            $totalIncome=Transaction::whereDate('created_at', Carbon::today())->sum('total_income');  
            $transactions=Transaction::whereDate('created_at', Carbon::today())->paginate(8);
            if(count($transactions)>0){
                return view('admin.transaction.index', ['transactions'=>$transactions, 'totalQty'=>$totalQty, 'totalIncome'=>$totalIncome]);
            }else{
                return back()->with('sucess', 'There was not availabele any transaction at yesterday');
            }  
        } else{
            return redirect()->route('admin.login');
        }
    }
    public function yesterdayTrasaction(){
        if(Auth::guard('admin')->check()){  
            $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
            $transactions=Transaction::whereDate('created_at', $yesterday)->paginate(8);
            $totalQty=Transaction::whereDate('created_at', $yesterday)->sum('total_qty');
            $totalIncome=Transaction::whereDate('created_at', $yesterday)->sum('total_income'); 
            if(count($transactions)>0){
                return view('admin.transaction.index', ['transactions'=>$transactions, 'totalQty'=>$totalQty, 'totalIncome'=>$totalIncome]);
            }else{
                return back()->with('sucess', 'There was not availabele any transaction at yesterday');
            }
         } else{
            return redirect()->route('admin.login');
        }
    }
    public function weekTrasaction(){
        if(Auth::guard('admin')->check()){  
            $now = Carbon::now();
            $start = $now->startOfWeek();
            $end = $now->endOfWeek();
            $transactions=Transaction::whereBetween('created_at', [$start, $end])->paginate(8);
            $totalQty=Transaction::whereBetween('created_at', [$start, $end])->sum('total_qty');
            $totalIncome=Transaction::whereBetween('created_at', [$start, $end])->sum('total_income'); 
            if(count($transactions)>0){
                return view('admin.transaction.index', ['transactions'=>$transactions, 'totalQty'=>$totalQty, 'totalIncome'=>$totalIncome]);
            }else{
                return back()->with('sucess', 'There was not availabele any transaction at this week');
            }
         } else{
            return redirect()->route('admin.login');
        }
    }

}
