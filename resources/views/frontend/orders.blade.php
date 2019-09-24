@extends('layouts.app')
@section('title','Orders')
@include('layouts.head')
@section('content')

    <div class="site-wrap">

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="/home">Home</a> <span class="mx-2 mb-0">/</span><a href="/shop">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Orders</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="site-blocks-table">
                        @include('flashMessage')
                        <p style="color:red">NOTE: YOU CANNOT CANCEL ORDER AFTER 3 HOURS!</p>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Ordered Products</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Time of Purchase</th>
                                    <th>Status</th>
                                    <th>Cancel</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>@csrf
                                @if($order->status!="For Delivery")
                                    <td>{{$order->id}}</td>
                                    <td style="text-align:center;">
                                        @foreach($order->orders as $pro)
                                            {{$pro['prod_name']}}<b><br/><i style="font-size:14px;">Qty: </b>{{$pro['prod_qty']}}</i><br/>
                                        @endforeach
                                    </td>
                                    <td>₱{{$order['total']}}</td>
                                    <td>{{$order['payment_method']}}</td>
                                    <td width="1;">{{$order->timeDifference()}}</td>
                                    <td>{{$order['status']}}</td>
                                    @if($order->canBeCancelled())
                                        <td>
                                            <form action="{{ route('orders.cancel', ['id'=> $order->id]) }}" method="POST">
                                            <button type="submit" class="btn btn-primary btn-sm" id="btnOrange" style="letter-spacing:1px;">Cancel</button>
                                            @csrf
                                            </form>
                                        </td>
                                    @endif
                                @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <div class="site-blocks-table">
                        <h2><strong>For Delivery</strong></h2>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Ordered Products</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Expected Time of Delivery</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>@csrf
                                @if($order->status=="For Delivery")
                                    <td>{{$order->id}}</td>
                                    <td style="text-align:center;">
                                        @foreach($order->orders as $pro)
                                            {{$pro['prod_name']}}<b><br/><i style="font-size:14px;">Qty: </b>{{$pro['prod_qty']}}</i><br/>
                                        @endforeach
                                    </td>
                                    <td>₱{{$order['total']}}</td>
                                    <td>{{$order['payment_method']}}</td>
                                    <td>{{$order->timeDelivery()}}</td>
                                    <td>{{$order['status']}}</td>
                                @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>

@endsection