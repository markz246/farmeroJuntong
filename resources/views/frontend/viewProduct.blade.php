@extends('layouts.app')
@section('title','Shop')
@include('layouts.head')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="site-wrap">

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="/home">Home</a> <span class="mx-2 mb-0">/</span><a href="/shop">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $productDetails['prod_name'] }}</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <form name="addtocartForm" id="addtocartForm" action="{{ url('/shop/addToCart') }}" method="post">@csrf
                    <div class="row">
                        <!--Details for Cart-->
                        <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                        <input type="hidden" name="prod_name" value="{{ $productDetails['prod_name'] }}">
                        <input type="hidden" name="prod_code" value="{{ $productDetails['prod_code'] }}">
                        <input type="hidden" name="price" value="{{ $productDetails['price'] }}">

                        <div class="col-md-6">
                            <img src="{{ url('/images/backend_images/products/large/',$productDetails['image']) }}" style="height:75%;" alt="Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-black">{{ $productDetails['prod_name'] }}</h2>
                            <p>Product Code: {{ $productDetails['prod_code'] }}</p>
                            <p>{{ $productDetails['description'] }}</p>
                            <p><strong class="text-primary h4">₱ {{ $productDetails['price'] }}</strong></p>
                            <div class="mb-5">
                                <div class="input-group mb-3" style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                    </div>
                                    <input type="text" class="form-control text-center" value="1" name="quantity" id="quantity" aria-label="Quantity" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray">Stocks: @if($totalstocks>0){{ $productDetails['stocks'] }} @else Out of Stock @endif</p>
                            @if($totalstocks>0)
                                <p><button type="submit" class="btn btn-sm btn-primary" id="btnOrange">Add To Cart</button></p>
                            @else
                                <p><button class="btn btn-sm btn-primary" id="btnOrange" disabled>Add To Cart</button></p>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js">') }}</script>

@endsection