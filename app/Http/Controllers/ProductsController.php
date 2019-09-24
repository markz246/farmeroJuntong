<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Products;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class ProductsController extends Controller
{
    public function addProducts(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die();

            if (empty($data['category_id'])){
                return redirect()->back()->with('error','Category is missing!');
            }
            $products = new Products();
            $products->category_id = $data['category_id'];
            $products->prod_name = $data['prod_name'];
            $products->prod_code = $data['prod_code'];
            $products->description = $data['description'];
            $products->price = $data['price'];
            $products->stocks = $data['stocks'];

            //Upload image
            if ($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;

                    //Resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->fit(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->fit(300,300)->save($small_image_path);

                    //Store image name in products table
                    $products->image = $filename;

                }
            }

            $products->save();
            return redirect()->back()->with('success','Product added successfully!');
        }
        $categories=Category::where('parent_id',0)->pluck('name','id')->all();
        return view('admin.products.addProduct',compact('categories'));
    }

    public function viewProduct(Request $request){
        $products=Products::orderBy('created_at','desc')->get();
        return view('admin.products.viewProduct',compact('products'));
    }

    public function editProduct(Request $request, $id=null){
        $update_product=Products::findOrFail($id);
        if ($request->isMethod('post')){
            $data = $request->all();

            if($update_product['image']=='') {
                if ($request->hasFile('image')) {
                    $image_tmp = Input::file('image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111, 99999) . '.' . $extension;
                        $large_image_path = 'images/backend_images/products/large/' . $filename;
                        $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                        $small_image_path = 'images/backend_images/products/small/' . $filename;

                        //Resize image
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                        $data['image'] = $filename;
                    }
                }
            }else {
                $data['image']=$update_product['image'];
            }

            Products::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
                                                  'prod_name'=>$data['prod_name'],
                                                  'prod_code'=>$data['prod_code'],
                                                  'description'=>$data['description'],
                                                  'price'=>$data['price'],
                                                  'stocks'=>$data['stocks']]);
            $update_product->update($data);
            return redirect('/admin/viewProduct')->with('success','Product updated successfully!');
        }
        $productDetails = Products::where(['id'=>$id])->first();
        $categories=Category::where('parent_id',0)->pluck('name','id')->all();
        $edit_category=Category::findOrFail($productDetails['category_id']);
        return view('admin.products.editProduct',compact('productDetails','categories','edit_category'));
    }

    public function deleteProductImage($id = null){
        Products::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('success','Image Deleted Successfully!');
    }

    public function deleteProduct(Request $request, $id = null){
        if (!empty($id)){
            Products::where(['id'=>$id])->delete();
            return redirect()->back()->with('success','Product deleted successfully!');
        }
    }
}
