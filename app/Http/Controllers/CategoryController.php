<?php

namespace App\Http\Controllers;

use App\Category;
use App\ParentCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Product;
class CategoryController extends Controller
{
  
     public function index()
    {
        //
         if(Auth::guard('admin')->check()){
        $categories= DB::table('categories')
        ->join('parent_categories', 'categories.cat_id', '=', 'parent_categories.id')
        ->orderBy('categories.created_at', 'desc')
        ->select('categories.*', 'parent_name')->paginate(8);
        return view('admin.category.child.categoryList', ['categories'=>$categories]);
         }
         return redirect()->route('admin.login');
    }
    public function create(){
        if(Auth::guard('admin')->check()){
        $parents=ParentCategory::all();
        return view('admin.category.child.createAndUpdate', ['parents'=>$parents]);
        }
         return redirect()->route('admin.login');

    }
    public function show(Category $category){
        if(Auth::guard('admin')->check()){
        $category = Category::find($category->id);
        $parents=ParentCategory::all();
        return view('admin.category.child.createAndUpdate', ['category'=>$category, 'parents'=>$parents]);
         }
         return redirect()->route('admin.login');
    }

    public function store(Request $request){
               $this->validate($request,[        
                      'child_name'=>'required|unique:categories'
                ]);
            $category=new Category([
                'cat_id'=>$request->get('id'),
                'child_name'=>$request->get('child_name'),
                ]);
            if($category->save()){
            return back()->with('sucess', 'sucessfully Added');
            }
            return back()->with('sucess', 'could not be added');
    }

    public function update(Request $request){
         $this->validate($request,[
            'child_name'=>'required|unique:categories'
                ]);
         $id=$request->get('id');
         $category=Category::find($id);
         $category->child_name=$request->get('child_name');
         if($category->save()){
        //    return redirect()->route('allchild');
        return back()->with('sucess', 'sucessfully updated');
         }
         return back()->with('sucess', 'could not be updated');

    }
    public function trashCategory(Request $request){
        $id =$request->get('id');
        $category=Category::find($id);
       if(count($category)>0){  
       $products=Product::where('child_id',$id)->get();
       foreach($products as $product){
          $product->status='off';
          $product->save();
          echo 'save';
       }
       $category->status='off';
      if($category->save()){
          return back()->with('sucess', 'sucessfully Trashed');
      }else{
          return back()->with('sucess', 'could not be trashed');
      }
    }else {
        return back()->with('sucess', 'could not be trashed');
    }

    }
    public function recoverCategory(Request $request){
        $id =$request->get('id');
        $category=Category::find($id);
        if(count($category)>0){
        $products=Product::where('child_id',$id)->get();
       foreach($products as $product){
          $product->status='on';
          $product->save();
          echo 'save';
       }
       $category->status='on';
      if($category->save()){
          return back()->with('sucess', 'sucessfully Recovered');
      }else{
          return back()->with('sucess', 'could not be Recovered');
      }
    }else{
        return back()->with('sucess', 'could not be Recovered');
    }
   }

}
