@extends('layouts.app')
@section('title','Shop')
@include('layouts.head')
@section('content')

    <div class="site-wrap">

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="/home">Home</a> <span class="mx-2 mb-0">/</span><a href="/shop">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
            @include('flashMessage')
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userCart as $cart)
                                <tr>@csrf
                                    <td class="product-thumbnail">
                                        <img src="{{ url('/images/backend_images/products/small/',$cart->image) }}" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $cart['prod_name'] }}</h2>
                                        <span style="font-size: 12px; font-style: italic; font-weight: bold;">Code: {{ $cart['prod_code'] }}</span>
                                    </td>
                                    <td>₱{{ number_format($cart['price'],2,'.',',') }}</td>
                                    <td>
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <a class="btn btn-outline-orange" href="{{ url('/shop/cart/updateCartQuantity/'.$cart['id'].'/-1') }}">&minus;</a>
                                            </div>
                                            <input type="text" class="form-control text-center" value="{{ $cart['quantity'] }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <a class="btn btn-outline-orange" href="{{ url('/shop/cart/updateCartQuantity/'.$cart['id'].'/1') }}">&plus;</a>
                                            </div>
                                        </div>

                                    </td>
                                    <td>₱{{ number_format($cart['price']*$cart['quantity'],2,'.',',') }}</td>
                                    <td><a href="{{ url('/shop/cart/deleteCartItem/'.$cart['id']) }}" class="btn btn-primary btn-sm" id="btnOrange">X</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <a class="btn btn-outline-orange btn-sm btn-block" href="/shop">Continue Shopping</a>
                            </div>
                        </div>
                        <form action="{{ url('/shop/cart/applyCoupon') }}" method="POST" role="form">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-black h4" for="coupon">Coupon</label>
                                    <p>Enter your coupon code if you have one.</p>
                                </div>
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <input type="text" class="form-control py-3" name="coupon_code" placeholder="Coupon Code">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-primary btn-sm" id="btnOrange" value="Apply Coupon"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                            @if(Session::has('couponAmount'))
                                <div class="row">
                                        <div class="col-md-12 text-right border-bottom mb-5">
                                            <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6">
                                            <span class="text-black">Subtotal</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <strong class="text-black">₱ {{number_format($total,2,'.',',')}}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6">
                                            <span class="text-black">Coupon</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <strong class="text-black">₱ {{Session::get('couponAmount')}}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <i style="font-size:12px;">(Code: {{Session::get('couponCode')}}</i>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <span class="text-black">Total</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <strong class="text-black">₱ {{number_format($total-Session::get('couponAmount'),2,'.',',')}}</strong>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">₱ {{number_format($total,2,'.',',')}}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">₱ {{number_format($total,2,'.',',')}}</strong>
                                    </div>
                                </div>
                            @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-lg py-3 btn-block" id="btnOrange" href="{{url('/shop/checkout')}}">Proceed To Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>

@endsection