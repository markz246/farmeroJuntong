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
        <div class="bg-white py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="/home">Home</a> <span class="mx-2 mb-0 ">/</span> <strong class="text-black">Shop</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">

                <div class="row mb-5">
                    <div class="col-md-9 order-2">

                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <?php
                            if($byCategory!=""){
                                $products=$list_product;
                            }
                            ?>
                            @foreach($products as $prod)
                                @if($prod->category->status==1)
                                    <div class="col-sm-6 col-md-4 mb-4">
                                        <div class="block-4 text-center border">
                                            <figure class="block-4-image">
                                                <a href="{{ url('/shop/viewProduct/'.$prod['id']) }}"><img  style="height:200px;" src="{{ url('/images/backend_images/products/large/',$prod->image) }}" alt="{{ $prod->prod_name }}" class="img-fluid"></a>
                                            </figure>
                                            <div class="block-4-text p-4">
                                                <h3><a href="#">{{ $prod->prod_name }}</a></h3>
                                                <!--<p class="mb-0">{{ $prod->description }}</p>-->
                                                <p class="text-primary font-weight-bold">₱ {{ $prod->price }}</p>
                                                <a class="btn btn-outline-orange" href="{{ url('/shop/viewProduct/'. $prod['id']) }}">View Product</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="row" data-aos="fade-up">
                            <div class="col-md-12 text-center">
                                <div class="site-block-27">
                                    <ul>
                                        <li><a href="#">&lt;</a></li>
                                        <li class="active"><span>1</span></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">&gt;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 order-1 mb-5 mb-md-0">
                        @include('frontend.categoryside')
                    </div>
                </div>

            </div>
        </div>
        @include('layouts.footer')
    </div>

@endsection