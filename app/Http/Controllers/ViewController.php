<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ParentCategory;
use App\Cart;
use Session;
use Auth;
use App\Calculation;
use Illuminate\Support\Facades\DB;
class ViewController extends Controller
{
    // vertually
    public function index(){
         // dd(request()->session()->get('cart'));
        // $cart=request()->session()->all('cart');
        // return $cart;
        // for tracking but not working
        $suggests='';
        $p_id='ID';
    // if(Auth::user()){
    //     $calculations=Calculation::with('user')->where('user_id', Auth::user()->id)->orderBy('created_at', 'dec')->get();
    //        foreach($calculations as $calculation){
    //            $suggests = Product::find($calculation->p_id)->paginate(10);
    //        }
        //    $parents=ParentCategory::with('childs')->get();
        //    $products= Product::where('status', 'on')->orderBy('created_at','dec')->paginate(30);
        //    $previousProducts=Product::where('status', 'on')->orderBy('created_at', 'asc')->paginate(9);
        //    return view('pages.index', ['products'=>$products, 'parents'=>$parents, 'suggests'=>$suggests]);
    // }else{
        $parents=ParentCategory::with('childs')->get();
        $products= Product::where('status', 'on')->orderBy('created_at','dec')->paginate(30);
        return view('pages.index', ['products'=>$products, 'parents'=>$parents]);   
    // }
    }

    public function viewInformation($name){
         $categories=Category::where('child_name', $name)->first();
         if(count($categories)>0){
            $products=Product::where('child_id', $categories->id)->where('status', 'on')->orderBy('created_at','dec')->paginate(30);;
            $parents=ParentCategory::with('childs')->get();
            return view('pages.index', ['products'=>$products, 'parents'=>$parents]);
         }else{
             return back();
         }
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
    }
    public function shopingCart(){
        if(!Session::has('cart')){
            return redirect()->route('/')->with('nothing in cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $parents=ParentCategory::with('childs')->get();
        return view('pages.shoping-cart', ['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'parents'=>$parents]);
    }

    public function getCheckout(Request $request){
      $parents=ParentCategory::with('childs')->get();
       $method=request()->get('method');
       $oldCart=Session::get('cart');
       $cart=new Cart($oldCart);
       if($method=='1'){
           return view('pages.checkOutCash', ['parents'=>$parents, 'cartItems'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
       }
       else if($method=='2'){
           return  view('pages.checkOutDebit', ['parents'=>$parents, 'cartItems'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
       }else if($method=='3'){
           return 'now in Fund transfer';
       }
       else if($method=='4'){
        return 'now in Other transfer';
    } else if($method=='5'){
        return 'now in OtheCash deliveryr transfer';
       }else{
        return view('pages.checkOutCash', ['parents'=>$parents, 'cartItems'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
       }
}
      
    // now not working
    public function getShowCartSection(){
      $oldCart=Session::get('cart')->items;
      $cart=new Cart($oldCart);
      $parents=ParentCategory::with('childs')->get();
      return redirect()->route('/');
    }
      public function updateCart(Request $request){
        $id= $request->get('p_id');
        $product =Product::find($id);
        $oldCart=Session::has('cart') ? Session::get('cart'): null;
        $cart=new Cart($oldCart);
        $cart->updateCarts($product, $product->id);
        $request->session()->put('cart', $cart);

         $qty='';
         if(Session::has('cart')){
            $qty= Session::get('cart')->totalQty;
        }
            echo $qty;
      
    }

    public function viewAbout(){
        $parents=ParentCategory::with('childs')->get();
        return view('pages.about', ['parents'=>$parents]);
    }
    public function viewBlog(){
        $parents=ParentCategory::with('childs')->get();
        return view('pages.blog', ['parents'=>$parents]);
    }
    public function viewContact(){
        $parents=ParentCategory::with('childs')->get();
        return view('pages.contact', ['parents'=>$parents]);
    }
    public function viewShoping(){
        $products =Category::with('products')->whereHas('products', function($q){
            $q->where('products.status','on');
        })->where('status', 'on')->get();
        // $parents=ParentCategory::with('childs')->get();
        // $products= Product::where('status', 'on')->orderBy('created_at','dec')->paginate(30);
        // return view('pages.shoping', ['products'=>$products, 'parents'=>$parents]);   
        return $products;
    }
    public function viewFeature(){
        $parents=ParentCategory::with('childs')->get();
        return view('pages.feature', ['parents'=>$parents]);
    }
    public function viewInformationPerticular($name){
        $categories=Category::where('child_name', $name)->first();
         if(count($categories)>0){
            $products=Product::where('child_id', $categories->id)->where('status', 'on')->orderBy('created_at','dec')->paginate(30);;
            $parents=ParentCategory::with('childs')->get();
            return view('pages.shoping', ['products'=>$products, 'parents'=>$parents]);
         }else{
             return back();
         }
    }
}
