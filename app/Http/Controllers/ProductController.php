<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         if(Auth::guard('admin')->check()){
         $products= DB::table('products')
                   ->join('categories', 'products.child_id', '=', 'categories.id')
                   ->orderBy('products.created_at', 'desc')
                   ->select('products.*', 'child_name')->paginate(2);
         return view('admin.product.productList', ['products'=>$products]);
        }
        return redirect()->route('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         if(Auth::guard('admin')->check()){
        $category=category::all();
        return view('admin.product.create',['category'=>$category]);
         }
        return redirect()->route('admin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[

              'image'=>'required',
              'name'=>'required',
              'description'=>'min:10|max:200',
              'price'=>'required',
              'qty'=>'required|integer',
              'size'=>'required',
              'color'=>'required|string'
            ]);
        $imageName='';
        $imageName=time().'.'.$request->image->getClientOriginalExtension();
        $path=$request->image->move(public_path('product'), $imageName);
        $child_name=$request->get('child_name');
        $category=Category::where('child_name', $child_name)->first();
        // return $category->id;
        $product=new Product([
                 'child_id'=>$category->id,
                 'p_name'=>$request->get('name'),
                 'description'=>$request->get('description'),
                 'price'=>$request->get('price'),
                 'qty'=>$request->get('qty'),
                 'discount'=>$request->get('discount'),
                 'available_qty'=>$request->get('qty'),
                 'color'=>$request->get('color'),
                 'size'=>$request->get('size'),
                 'status'=>$request->get('switch14'),
                 'path'=>$imageName
            ]);
        if($product->save()){
            return redirect()->route('allproduct');
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
         if(Auth::guard('admin')->check()){
        $pro = Product::find($product->id);
        $category=Category::all();
        return view('admin.product.update', ['product'=>$pro, 'category'=>$category]);
        }
        return redirect()->route('admin.login');
        // return $pro;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $this->validate($request,[

              'image'=>'required',
              'name'=>'required',
              'description'=>'min:10|max:200',
              'price'=>'required',
              'qty'=>'required|integer',
              'size'=>'required',
              'color'=>'required|string'
            ]);
        $path = '';
        $imageName=time().'.'.$request->image->getClientOriginalExtension();
        $path=$request->image->move(public_path('product'), $imageName);
        $child_name=$request->get('child_name');
        $category=Category::where('child_name', $child_name)->first();
        $product=Product::find($product->id);
        $product->p_name=$request->get('name');
        $product->description=$request->get('description');
        $product->price=$request->get('price');
        $product->discount=$request->get('discount');
        $product->qty=$request->get('qty');
        $product->color=$request->get('color');
        $product->size=$request->get('size');
        $product->available_qty=$request->get('available_qty');
         $product->path=$imageName;
        if($product->save()){
            return redirect()->route('allproduct', ['sucess', 'Producted Updated sucessfully']);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        //
       
    }
}
