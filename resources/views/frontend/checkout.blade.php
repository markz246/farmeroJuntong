@extends('layouts.app')
@section('title','Shop')
@include('layouts.head')
@section('content')

  <div class="site-wrap">

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/home">Home</a> <span class="mx-2 mb-0">/</span> <a href="{{url('/shop/cart')}}">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <form action="{{url('/shop/checkoutOrder')}}" method="post" class="form-horizontal">
    @csrf
      <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Billing Details</h2>
              <div class="p-3 p-lg-5 border">
                @foreach($userInfo as $user)
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Customer Name</label>
                    <input type="text" class="form-control" name="name" value="{{$user['name']}}">
                  </div> 
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label class="text-black">Address</label>
                    <div class="form-group row">
                      <div class="col-md-6">
                          <label class="text-black">Street</label>
                          <input type="text" class="form-control" name="street" value="{{$user['address_street']}}">
                      </div>
                      <div class="col-md-6">
                          <label class="text-black">Barangay</span></label>
                          <input type="text" class="form-control" name="barangay" value="{{$user['address_barangay']}}">
                      </div>
                      <div class="col-md-6">
                          <label class="text-black">City</label>
                          <input type="text" class="form-control" name="city" value="{{$user['address_city']}}">
                      </div>
                      <div class="col-md-6">
                          <label class="text-black">Province</span></label>
                          <input type="text" class="form-control" name="province" value="{{$user['address_province']}}">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-6">
                    <label class="text-black">Email Address</label>
                    <input type="text" class="form-control" name="user_email" value="{{$user['email']}}" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="text-black">Phone</label>
                    <input type="text" class="form-control" name="contact" placeholder="Phone Number" value="{{$user['contact']}}">
                  </div>
                </div>

                <div class="form-group">
                  <label class="text-black">Order Notes</label>
                  <textarea name="order_notes" class="form-control" placeholder="Write your notes here..."></textarea>
                </div>
                @endforeach
              </div>
            </div>

            <div class="col-md-6">
              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Your Order</h2>
                  <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th style="text-align:center;">Image</th>
                        <th style="text-align:center;">Product</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Total</th>
                      </thead>
                      <tbody>
                        @foreach($userCart as $order)
                        <tr>
                          <td><img src="{{ url('/images/backend_images/products/small/',$order['image']) }}" alt="Image" class="img-fluid" style='width:50px;'></td>
                          <td>{{$order['prod_name']}}</td>
                          <td style="text-align:center;">{{$order['quantity']}}</td>
                          <td style="text-align:right;">₱{{number_format($order['price']*$order['quantity'],2,'.',',')}}</td>
                        </tr>
                        @endforeach
                        @if(Session::has('couponAmount'))
                          <tr>
                            <td></td><td></td>
                            <td  style="text-align:right;"><strong>Subtotal</strong></td>
                            <td class="text-black" style="text-align:right;">₱{{$total}}</td>
                          </tr>
                          <tr style="text-align:right; font-size:12px;">
                            <td></td><td></td>
                            <td class="text-black font-weight-bold"><strong>Coupon</strong></td>
                            <span>(Code: {{Session::get('couponCode')}}</span>
                            <td class="text-black" style="text-align:right;">₱{{Session::get('couponAmount')}}</td>
                          </tr>
                          <tr>
                            <td></td><td></td>
                            <td class="text-black font-weight-bold" style="text-align:right;"><strong>Total</strong></td>
                            <td class="text-black font-weight-bold" style="text-align:right;"><strong>₱ {{number_format($total-Session::get('couponAmount'),2,'.',',')}}</strong></td>
                          </tr>
                        @else
                          <tr>
                            <td></td><td></td>
                            <td ><strong>Subtotal</strong></td>
                            <td class="text-black" >₱{{number_format($total,2,'.',',')}}</td>
                          </tr>
                          <tr>
                            <td></td><td></td>
                            <td class="text-black font-weight-bold" style="text-align:right;"><strong>Total</strong></td>
                            <td class="text-black font-weight-bold" style="text-align:right;"><strong>₱{{number_format($total,2,'.',',')}}</strong></td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                    @include('flashMessage')
                    <h2 class="h3 mb-3 text-black">Payment Method</h2>

                    <div class="p-3 mb-1">
                      <h3 class="h6 mb-0"><a name="payment_method" href="https://api.sandbox.paypal.com"><img src="{{url('/images/paypal.png')}}" style="width:20%;" alt="PayPal"></a></h3>
                    </div>
                    <div class="p-3 mb-1">
                      <h3 class="h6 mb-0"><label class="checkbox" style="font-size:16px; color:black;"><input type="checkbox" name="payment_method" value="COD"> Cash On Delivery</h3>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.html'" id="btnOrange">Place Order</button>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="user_id" value="{{$user['id']}}">
      <input type="hidden" name="user_email" value="{{$user['email']}}">
      <input type="hidden" name="shipping_charges" value="0">
      @if(Session::has('couponAmount'))
          <input type="hidden" name="coupon_code" value="{{Session::get('couponCode')}}">
          <input type="hidden" name="coupon_amount" value="{{Session::get('couponAmount')}}">
          <input type="hidden" name="total" value="{{$total-Session::get('couponAmount')}}">
      @else
          <input type="hidden" name="coupon_code" value="NO Coupon">
          <input type="hidden" name="coupon_amount" value="0">
          <input type="hidden" name="total" value="{{$total}}">
          <input type="hidden" name="status" value="Pending">
      @endif
    </form>
    @include('layouts.footer')
  </div>

@endsection