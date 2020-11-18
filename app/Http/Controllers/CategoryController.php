<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return $category;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $cat_img_url = $request->cat_img_url;
        if (!$name && !$cat_img_url){
            return response()->json(['err' => ['one of the fields is not entered']],400);
         }
        $category = Category::where('id',$request->id)->first();
        if ($category) {
            if ($name) {
                $category->name = $name;
            } 
            if ($cat_img_url){
                $category->cat_img_url = $cat_img_url;
            } 
            $category->save();
        } else {
            if ( $name && $cat_img_url) {
            $category = Category::create([
                'name' => $name,
                'cat_img_url' => $cat_img_url
              ]);
            } else {
                return response()->json(['err' => ['not found files']],400);
            }
        }
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (!$request->name && !$request->cat_img_url){
            return response()->json(['err' => ['one of the fields is not entered']],400);
         }
        if ($request->name) {
            $category->name = $request->name;
        } 
        
        if ($request->cat_img_url){
            $category->cat_img_url = $request->cat_img_url;
        } 
        $category->save();
       return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return true;
    }
}
