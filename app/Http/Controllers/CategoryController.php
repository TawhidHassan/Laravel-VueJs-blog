<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, [
            'cat_name' => 'required|min:5|max:30',
        ]);
        $category=new Category();
        $category->cat_name=$request->cat_name;
        $category->save();
        return['massage'=>'ok add done'];
    }
    public function all()
    {
        $categories=Category::all();
        return response()->json([
            'categories'=>$categories
        ],200);

    }
    public function delete($id)
    {

        $categories=Category::find($id);
        $categories->delete();


    }
    public function edit($id)
    {
        $categories=Category::find($id);
       return response()->json([
           'category'=>$categories
       ],200);

    }
    public function update(Request $request,$id)
    {
        $categories=Category::find($id);
        $categories->cat_name=$request->cat_name;
        $categories->save();


    }
    public function selected_category($ids){
        $all_id = explode(',',$ids);
        foreach ($all_id as $id){
            $category = Category::find($id);
            $category->delete();
        }
    }

}
