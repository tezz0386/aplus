<?php

namespace App\Http\Controllers;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function index()
    {
        $transactions=Transaction::with('order')->orderBy('created_at', 'dec')->paginate(8);
        // return view('admin.transaction.index', ['transactions'=>$transactions]);
        return $transactions;
    }
}
