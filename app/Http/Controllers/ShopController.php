<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Products;

class ShopController extends Controller
{
    //
    public function index(){
        $products=Products::all()->sortByDesc('id');
        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
        $byCategory="";
        //echo "<pre>"; print_r($categories);die();
        return view('frontend.shop',compact('products','categories','byCategory'));
    }

    public function shop(){
        $products=Products::all();
        $byCategory="";
        return view('frontend.shop',compact('products','byCategory'));
    }

    public function listByCat($id = null){
        $list_product=Products::where('category_id',$id)->get();
        $byCategory=Category::select('name')->where('id',$id)->first();
        return view('frontend.shop',compact('byCategory','list_product'));
    }

    public function viewProduct($id = null){
        $productDetails = Products::where('id',$id)->first();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $totalstocks = Products::where('id',$id)->sum('stocks');
        return view('frontend.viewProduct',compact('productDetails','categories','totalstocks'));
    }
}



