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
                   ->select('products.*', 'child_name')->paginate(8);
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
        return view('admin.product.create',['categories'=>$category]);
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
              'p_name'=>'required|unique:products',
              'price'=>'required',
              'qty'=>'required|integer',
              'size'=>'required',
              'color'=>'required|string'
            ]);
        $id='';
        if($request->get('child_name')!=null){
            $category=Category::where('child_name', $request->get('child_name'))->first();
            $id=$category->id;
        }else{
            $id=$request->get('id');
        }
        $imageName='';
        $imageName=time().'.'.$request->image->getClientOriginalExtension();
        $path=$request->image->move(public_path('product'), $imageName);
        // return $category->id;
        $status='';
        if($request->get('switch14')==''){
            $status='off';
        }else{
            $status=$request->get('switch14');
        }
        $product=new Product([
                 'child_id'=>$id,
                 'p_name'=>$request->get('p_name'),
                 'description'=>$request->get('description'),
                 'price'=>$request->get('price'),
                 'qty'=>$request->get('qty'),
                 'discount'=>$request->get('discount'),
                 'available_qty'=>$request->get('qty'),
                 'color'=>$request->get('color'),
                 'status'=>$status,
                 'path'=>$imageName
            ]);
        if($product->save()){
            // return redirect()->route('allproduct');
            return back()->with('sucess', 'successfully product added');
        }
        return back()->with('could not be added');
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
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'p_name'=>'required',
            'description'=>'min:10|max:200',
            'price'=>'required',
            'qty'=>'required|integer',
            'color'=>'required|string'
          ]);
        $status='';
        if($request->get('switch14')==''){
            $status='off';
        }else{
            $status=$request->get('switch14');
        }
        if($_FILES['image']['size'] == 0) {
            $product=Product::find($request->get('id'));
            $product->p_name=$request->get('p_name');
            $product->description=$request->get('description');
            $product->price=$request->get('price');
            $product->discount=$request->get('discount');
            $product->status=$status;
            if($request->get('qty')==$product->qty){
                $product->available_qty=$request->get('available_qty');
            } else{
                $product->available_qty=$product->available_qty+$request->get('qty');
            }
            $product->qty=$request->get('qty');
            $product->color=$request->get('color');
            $product->size=$request->get('size');
        }else{
        $path = '';
        $imageName=time().'.'.$request->image->getClientOriginalExtension();
        $path=$request->image->move(public_path('product'), $imageName);
        $product=Product::find($request->get('id'));
        $product->p_name=$request->get('name');
        $product->description=$request->get('description');
        $product->price=$request->get('price');
        $product->discount=$request->get('discount');
        $product->status=$status;
        if($request->get('qty')==$product->qty){
            $product->available_qty=$request->get('available_qty');
        } else{
            $product->available_qty=$product->available_qty+$request->get('qty');
        }
        $product->qty=$request->get('qty');
        $product->color=$request->get('color');
        $product->size=$request->get('size');
        $product->path=$imageName;
        }
        if($product->save()){
            // return redirect()->route('allproduct', ['sucess', 'Producted Updated sucessfully']);
            return back()->with('sucess', 'sucessfully Updated');
        }
        return back()->with('sucess', 'could not be updated');
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
    public function trashProduct(Request $request){
       $product=Product::find($request->get('id'));
       if($product->status=='off'){
             return back()->with('sucess', 'could not be trashed again');
       }else{
        $product->status='off';
        if($product->save()){
         return redirect()->route('allproduct')->with('sucess', 'Trashed Sucessfully Now you can see the trashed list of product');
        }else{
            return back()->with('sucess', 'Something is wrong could not be trash');
        }
       }
    }
    public function deleteProduct(Request $request){
        $product=Product::find($request->get('id'));
        if($product->delete()){
            return redirect()->route('allproduct')->with('sucess', 'Deletion sucessfully');
        }else{
            return back()->with('sucess', 'could not be deleted');
        }
    }
    public function recoverProduct(Request $request){
        $product=Product::find($request->id);
        if($product->ststus=='on'){
            return back()->with('sucess', 'could not be recover again');
        }else{
            $product->status='on';
            if($product->save()){
                return redirect()->route('allproduct')->with('sucess', 'Sucessfully Recovered');
            }else{
                return back()->with('sucess', 'some thing is going to wrong, could not be recover again');
            }
        }
    }
    public function getTrash(){
       $products=Product::where('status', 'off')->orderBy('updated_at', 'dec')->paginate(8);
       return view('admin.product.trash', ['products'=>$products]);
    }
}
