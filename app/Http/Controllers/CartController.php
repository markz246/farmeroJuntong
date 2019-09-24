<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Products;
use App\User;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
        public function addToCart(Request $request){

        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die();
            if (empty($data['user_email'])){
                $data['user_email']='';
            }

            $user_id = $request->user()->id;

            if (empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }

            //echo "<pre>"; print_r($user_id); die();

            /*$countCart = Cart::where(['product_id'=>$data['product_id'],'prod_name'=>$data['prod_name'],
                'prod_code'=>$data['prod_code'],'price'=>$data['price'],'session_id'=>$session_id])->count();*/

            $cart = new Cart();
            $cart->product_id = $data['product_id'];
            $cart->prod_name = $data['prod_name'];
            $cart->prod_code = $data['prod_code'];
            $cart->price = $data['price'];
            $cart->quantity = $data['quantity'];
            $cart->user_id = $user_id;
            $cart->user_email = $data['user_email'];
            $cart->session_id = $session_id;
            $cart->save();
        }
        return redirect('/shop/cart')->with('success','Product added to cart');
    }

    public function cart(){
        $user_id = Auth::id();
        //$session_id = Session::getId();
        $userCart = Cart::where(['user_id'=>$user_id])->get();
        //echo "<pre>"; print_r($userCart);
        $total=0;
        foreach($userCart as $cart){
            $total+=$cart['price']*$cart['quantity'];
        }
        foreach ($userCart as $key => $product){
            $productDetails = Products::where('id',$product['product_id'])->first();
            $userCart[$key]->image = $productDetails['image'];
        }
        return view('frontend.cart',compact('userCart','total'));
    }

    public function deleteCartItem($id = null){
        if (!empty($id)){
            Cart::where(['id'=>$id])->delete();
            return redirect()->back()->with('success','Item has been deleted');
        }
        return view('frontend.cart');
    }

    public function updateCartQuantity($id = null, $quantity = null){
        $getCartDetails = Cart::where('id',$id)->first();
        $getProductDetails = Products::where('id',$getCartDetails['product_id'])->first();

        echo $getProductDetails['stocks']; echo "--";
        $updated_quantity = $getCartDetails['quantity']+$quantity;
        if ($getProductDetails['stocks'] >= $updated_quantity){
            Cart::where('id',$id)->increment('quantity',$quantity);
            return redirect('/shop/cart')->with('success','Quantity updated!');
        }else{
            return redirect('/shop/cart')->with('error','Maximum stocks obtained!');
        }
    }
}
