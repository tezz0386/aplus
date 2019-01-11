<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ParentCategory;
use App\Cart;
use Session;
use Illuminate\Support\Facades\DB;
class ViewController extends Controller
{
    // vertually
    public function index(){
         // dd(request()->session()->get('cart'));
        // $cart=request()->session()->all('cart');
        // return $cart;
    $parents=ParentCategory::with('childs')->get();
    $products= Product::where('status', 'on')->orderBy('created_at','dec')->paginate(30);
    $previousProducts=Product::where('status', 'on')->orderBy('created_at', 'asc')->paginate(9);
    return view('pages.index', ['products'=>$products, 'parents'=>$parents, 'previousProducts'=>$previousProducts]);
    }

    public function viewInformation($name){
         $categories=Category::where('child_name', $name)->first();
         $products=Product::where('child_id', $categories->id)->where('status', 'on')->orderBy('created_at','dec')->paginate(30);;
         $parents=ParentCategory::with('childs')->get();
          return view('pages.index', ['products'=>$products, 'parents'=>$parents]);

    }
    public function cart(Request $request){
        $id= $request->get('p_id');
        $product =Product::find($id);
        $oldCart=Session::has('cart') ? Session::get('cart'): null;
        $cart=new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);

         $qty='';
         if(Session::has('cart')){
            $qty= Session::get('cart')->totalQty;
            }
            echo $qty;
        // dd($request->session()->get('cart'));
    }
    public function shopingCart(){
        // return view('pages.shoping-cart');
        if(!Session::has('cart')){
            return redirect()->route('/')->with('nothing in cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $parents=ParentCategory::with('childs')->get();
        return view('pages.shoping-cart', ['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'parents'=>$parents]);
    }

    public function getCheckout(){
      $parents=ParentCategory::with('childs')->get();
       $method=request()->get('method');
       $oldCart=Session::get('cart');
       $cart=new Cart($oldCart);
       if($method=='1'){
           return  view('pages.checkOutDebit', ['parents'=>$parents, 'cartItems'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
       }else if($method=='2'){
           return 'now in Fund transfer';
       }
       else if($method=='3'){
        return 'now in Other transfer';
    } else if($method=='4'){
        return 'now in OtheCash deliveryr transfer';
       }else{
           return back()->with('error', 'please choose a method type');
       }
}
      
    // mow not working
    public function getShowCartSection(){
      $oldCart=Session::get('cart')->items;
      $cart=new Cart($oldCart);
      $parents=ParentCategory::with('childs')->get();
      return view('pages.cartSection', ['parents'=>$parents, 'carts'=>$cart]);
    }
}
