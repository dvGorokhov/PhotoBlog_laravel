<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET
     * http://127.0.0.1:8000/api/auth/photo
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $photo = Photo::where('category_id',$request->category_id)->get();
        return $photo;
    }

    /**
     * Store a newly created resource in storage.
     * POST
     * http://127.0.0.1:8000/api/auth/photo
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $photo = $request->url;
        $category_id = $request->category_id;

        if ($photo && $category_id) {
            $new_photo = Photo::create([
            'url' => $photo,
            'category_id' => $category_id
          ]);
        } else {
            return response()->json(['err' => ['not found files']],400);
        }
        return $new_photo;
    }

    /**
     * Display the specified resource.
     * GET
     * http://127.0.0.1:8000/api/auth/photo/1
     * 
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Update the specified resource in storage.
     * PATCH
     * http://127.0.0.1:8000/api/auth/photo/2
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
       if ($request->url){
           $photo->url = $request->url;
       }
       if ($request->category_id){
           $photo->category_id = $request->category_id;
       }
        $photo->save();
       
    }

    /**
     * Remove the specified resource from storage.
     * DELETE
     * http://127.0.0.1:8000/api/auth/photo/1
     * 
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return true;
    }
}
