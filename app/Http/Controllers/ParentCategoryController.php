<?php

namespace App\Http\Controllers;

use App\ParentCategory;
use Illuminate\Http\Request;
use Auth;
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
        // $parents=ParentCategory::with('childs')->get();
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
        return view('admin.category.parent.create');
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
               'name'=>'required',
               'description'=>'min:10|max:200'
            ]);
        $parent= new ParentCategory([
            'parent_name'=>$request->get('name'),
            'description'=>$request->get('description')
            ]);
        if($parent->save()){
            $parents=ParentCategory::all();
            return redirect()->route('list');
            // return view('admin.category.parent.categoryList', ['parents'=>$parents])->with('sucess', 'Parent Category Added Sucessfully');
        }
       return back()->withInput();
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
    public function update(Request $request,$id)
    {
        //
        $parent=ParentCategory::find($id);
        $parent->parent_name=$request->get('name');
        $parent->description=$request->get('description');
        if($parent->save()){
            return redirect()->route('list');
            // return view('admin.category.parent.categoryList', ['parents'=>$parents])->with('sucess', 'Parent Category Updated as well all the child category, Sucessfully');
        }
        return back()->withInput();
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
}
