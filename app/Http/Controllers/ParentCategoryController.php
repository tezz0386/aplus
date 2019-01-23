<?php

namespace App\Http\Controllers;

use App\ParentCategory;
use Illuminate\Http\Request;
use Auth;
use App\Product;
use Illuminate\Support\Facades\DB;
class ParentCategoryController extends Controller
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
        $parents=ParentCategory::all();
        return view('admin.category.parent.categoryList', ['parents'=>$parents]);
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
            $parents=ParentCategory::with('childs')->get();
            return view('admin.category.parent.create', ['parents'=>$parents]);
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
               'parent_name'=>'required|unique:parent_categories'
            ]);
        $parent= new ParentCategory([
            'parent_name'=>$request->get('parent_name'),
            ]);
        if($parent->save()){
            $parents=ParentCategory::all();
            // return redirect()->route('list');
            return back()->with('sucess', 'sucessfully Added');
        }
       return back()->withInput()->with('error', 'could not be added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(Auth::guard('admin')->check()){
        $parent=ParentCategory::find($id);
        return view('admin.category.parent.create', ['parent'=>$parent]);
         }
         return redirect()->route('admin.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentCategory $parentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'parent_name'=>'required|unique:parent_categories'
         ]);
        $id=$request->get('id');
        $parent=ParentCategory::find($id);
        $parent->parent_name=$request->get('parent_name');
        if($parent->save()){
            return back()->with('sucess', 'sucessfully updated');
        }
        return back()->withInput()->with('sucess', 'could not be Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentCategory $parentCategory, $id)
    {
        //
        return $id;
    }
    public function viewProduct($id){
        if(Auth::guard('admin')->check()){
            $products= DB::table('products')
                      ->join('categories', 'products.child_id', '=', 'categories.id')
                      ->orderBy('products.created_at', 'desc')
                      ->select('products.*', 'child_name')->where('child_id', $id)->paginate(8);
            if(count($products)>0){
                return view('admin.product.productList', ['products'=>$products]);
            }else{
                return back()->with('sucess', 'Now the product has not been added');
            }
           }
           return redirect()->route('admin.login');
    }
}
