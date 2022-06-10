<?php

namespace App\Http\Controllers;

use App\Models\ImageCrud;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\file as Facadesfile;

class ImageCrudController extends Controller
{
   public function create(Request $request){

        $image= new ImageCrud();
        $request->validate([
            'title' =>'required',
            'image'=>'required|max:1024'
        ]);

        $filename=NULL;
        if($request->hasFile('image')){
            $filename=$request->file('image')->store('posts','public');           
        }
        
        $image->title=$request->title;
        $image->image=$filename;
        $result=$image->save();

        $returnvalue = response()->json(['success'=>false]);

        if($result){
            $returnvalue = response()->json(['success'=>true]);
        }

        return $returnvalue;
   }

   public function get(){
        $images=ImageCrud::orderBy('id','DESC')->get();
        return response()->json($images);
   }

   public function edit($id){
        $images= ImageCrud::findOrFail($id);
        return response()->json($images);
   }

   public function update(Request $request,$id){
        $images=ImageCrud::findOrFail($id);

        $destination=public_path("storage\\".$images->image);
        $filename="";
        if($request->hasFile('new_file')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_image')->store('posts','public');
        }else{
            $filename=$request->image;
        }

        $images->title=$request->title;
        $images->image=$filename;
        $result=$images->save();
        $returnvalue = response()->json(['success'=>false]);

        if($result){
            $returnvalue = response()->json(['success'=>true]);
        }

        return $returnvalue;
       
   }
}
