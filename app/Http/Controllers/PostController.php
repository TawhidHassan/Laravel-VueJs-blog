<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function all_post()
    {
        $post=Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts'=>$post
        ],200);
    }
    public function addnewpost(Request $request)
    {

        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);


        $post=new Post();

        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $img = Image::make($request->photo)->resize(400, 200);
        $name = time().".".$ex;
        $upload_path = public_path()."/uploadimage/";
        $img->save($upload_path.$name);

        $post->title=$request->title;
        $post->description=$request->description;
        $post->category_id=$request->category_id;
        $post->user_id=Auth::user()->id;
        $post->photo = $name;
        $post->save();

    }
    public function deletepost($id){
        $post = Post::find($id);
        $image_path = public_path()."/uploadimage/";
        $image = $image_path. $post->photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $post->delete();
    }
    public function edit_post($id){
        $post=Post::find($id);
        return response()->json([
            'posts'=>$post
        ],200);
    }
    public function update_post(Request $request, $id){
        $post = Post::find($id);
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
        if($request->photo!=$post->photo){
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(400, 200);
            $upload_path = public_path()."/uploadimage/";
            $image = $upload_path. $post->photo;
            $img->save($upload_path.$name);
            if(file_exists($image)){
                @unlink($image);
            }
        }else{
            $name = $post->photo;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }
}
