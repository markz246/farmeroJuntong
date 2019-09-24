<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Cart;
use App\Order;
use App\Products;
use Carbon\Carbon;
use App\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('frontend.checkoutSuccess');
    }

    public function order(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            /*if(empty($payment_method)){
                return redirect()->back()->with('error','Please select payment method.');
            }*/
            if (empty($data['order_notes'])){
                $data['order_notes']='';
            }
            //echo "<pre>"; print_r($data); die;
            Order::create($data);
            
            $user_id = Auth::id();
            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = Cart::where(['user_id'=>$user_id])->get();
            foreach($cartProducts as $prod){
                $cartProd = new OrderDetails;
                $cartProd->order_id = $order_id;
                $cartProd->user_id = $user_id;
                $cartProd->prod_id = $prod['product_id'];
                $cartProd->prod_name = $prod['prod_name'];
                $cartProd->prod_code = $prod['prod_code'];
                $cartProd->prod_price = $prod['price'];
                $cartProd->prod_qty = $prod['quantity'];
                
                $cartProd->save();

                $product = Products::find($prod['product_id']);
                $product['stocks'] = $product['stocks'] - $prod['quantity'];
                $product->save();
            }
            Cart::where(['user_id'=>$user_id])->delete();
            return redirect('/shop/checkoutSuccess');
        }
    }

    public function viewOrders(){
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('frontend.orders',compact('orders'));
    }

    public function viewOrdersAdmin(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        
        return view('admin.orders.viewOrders',compact('orders'));
    }

    public function viewOrdersAdminDelivery(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        
        return view('admin.orders.delivery',compact('orders'));
    }

    public function cancelOrder($id){
        //$orderDetails = OrderDetails::where('order_id',$id)->get();
        Order::where('id',$id)->update(['status'=>"Cancelled"]);
        
        /*foreach($orders as $order){
            Order::where('id',$order['id'])->update(['status'=>"Cancelled"]);
            

            /*foreach($orderDetails as $orderDetail){
                $product = Products::find($orderDetail['prod_id']);
                $product['stocks'] = $product['stocks'] + $orderDetail['prod_qty'];
                dd($orderDetail['prod_qty']);
                
                Products::where('id',$product)->update(['stocks'=>$product['stocks']]);
                Order::where('id',$order_id)->update(['status'=>$order['status']="Cancelled"]);
            }*/
        
        return redirect('/orders')->with('info','Order Cancelled');
    }
    public function forDelivery($id){
        if (!empty($id)){
            Order::where('id',$id)->update(['status'=>"For Delivery"]);
            return redirect()->back()->with('info','Transferred to For Delivery');
        }    
    }
}
