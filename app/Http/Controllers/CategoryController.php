<?php

namespace App\Http\Controllers;

use App\Category;
use App\ParentCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
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
                      'cat_name'=>'required',
                      'name'=>'required',
                      'description'=>'min:10|max:200'

                ]);
            $cat_name=$request->get('cat_name');
            $parent=ParentCategory::where('parent_name', $cat_name)->first();
            $category=new Category([
                'cat_id'=>$parent->id,
                'child_name'=>$request->get('name'),
                'description'=>$request->get('description')
                ]);
            if($category->save()){
               return redirect()->route('allchild');
            }
            return back();
    }

    public function update(Request $request ,$id){
         $this->validate($request,[
                      'cat_name'=>'required',
                      'name'=>'required',
                      'description'=>'min:10|max:200'
                ]);
         $parent_name=$request->get('cat_name');
         $parent=ParentCategory::where('parent_name', $parent_name)->first();
         $category=Category::find($id);
         $category->cat_id=$parent->id;
         $category->child_name=$request->get('name');
         $category->description=$request->get('description');
         if($category->save()){
           return redirect()->route('allchild');
         }
         return back();

    }
    public function destroy($id){
        if(Auth::guard('admin')->check()){
        $category=Category::find($id);
        if($category->delete()){
           return redirect()->route('allchild');
        }
        return back();
      }
      return redirect()->route('admin.login');
    }

}
