<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Cart;
use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.viewCoupon',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.addCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon_code'=>'required|min:5|max:15|unique:coupons,coupon_code',
            'amount'=>'required|numeric|between:1,99',
            'expiry_date'=>'required|date'
        ]);
        $data=$request->all();
        if(empty($data['status'])){
            $data['status']=1;
        }
        echo "<pre>"; print_r($data); die;
        Coupon::create($data);
        //return back()->with('success', 'Coupon added succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCoupons=Coupon::findOrFail($id);
        return view('admin.coupons.editCoupon',compact('editCoupons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateCoupon=Coupon::findOrFail($id);
        $this->validate($request,[
            'coupon_code'=>'required|min:5|max:15|unique:coupons,coupon_code,'.$updateCoupon->id,
            'amount'=>'required|numeric|between:1,99',
            'expiry_date'=>'required|date'
        ]);
        $data=$request->all();
        if(empty($data['status'])){
            $data['status']=1;
        }
        $updateCoupon->update($data);
        return redirect()->route('coupon.index')->with('success','Coupon edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteCoupon=Coupon::findOrFail($id);
        $deleteCoupon->delete();
        return redirect()->back()->with('success','Coupon deleted successfully!');
    }
    
    public function applyCoupon(Request $request){
        Session::forget('couponAmount');
        Session::forget('couponCode');
        
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $countCoupon = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($countCoupon == 0){
            return redirect()->back()->with('error','Coupon not found!');
        }else{
            $user_id=Auth::id();
            $userCart = Cart::where(['user_id'=>$user_id])->get();
            $totalAmount=0;
            foreach($userCart as $cart){
                $totalAmount+=$cart['price']*$cart['quantity'];
            }

            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            $expiryDate = $couponDetails['expiry_date'];
            $currentDate = date('Y-m-d');
            if($expiryDate < $currentDate){
                return redirect()->back()->with('error','Coupon is expired!');
            }else{
                $couponAmount = $totalAmount * ($couponDetails['amount']/100);
                Session::put('couponAmount',$couponAmount);
                Session::put('couponCode',$data['coupon_code']);

                return redirect()->back()->with('success','Coupon applied!');
            }
        }
    }
}
