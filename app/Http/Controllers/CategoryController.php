<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die();

            $category = new Category();
            $category->name = $data['name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->save();
            return redirect('/admin/viewCategory')->with('success','Category added successfully!');
        }
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.category.addCategory', compact('levels'));
    }

    public function viewCategory(){
        $categories = Category::all()->toArray();
        return view('admin.category.viewCategory',compact('categories'));
    }

    public function editCategory(Request $request, $id=null){
        if ($request->isMethod('post')){
            $data = $request->all();

            Category::where(['id'=>$id])->update(['name'=>$data['name'],'parent_id'=>$data['parent_id'],'description'=>$data['description']]);
            return redirect('/admin/viewCategory')->with('success','Category updated successfully!');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.category.editCategory',compact('categoryDetails','levels'));
    }

    public function deleteCategory(Request $request, $id = null){
        if (!empty($id)){
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('success','Category deleted successfully!');
        }
    }

    public function checkCateName(Request $request){
        $data=$request->all();
        $category_name=$data['name'];
        $ch_cate_name_atDB= Category::select('name')->where('name',$category_name)->first();
        if($category_name==$ch_cate_name_atDB['name']){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
}
