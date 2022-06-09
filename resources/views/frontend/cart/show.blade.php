@extends('frontend.layouts.master')

@section('mainContent')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">

                <div class="cart-list-title  text-center">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-12">
                            <p>Image</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <p>Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Update</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                @php
                    $total = 0;
                @endphp
                @foreach ($contents as $content)
                    <div class="cart-single-list text-center">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-2 col-12">
                                <a href="#!"><img src="{{ asset($content->options['image']) }}" alt="#"></a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-12">
                                <h5 class="product-name"><a href="#!">{{ $content->name }}</a>
                                </h5>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="form-group">
                                    <input type="number" value="{{ $content->qty }}" name="qty" min="0" max="5"
                                        class="form-control" id="qty" placeholder="Quantity">
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <i class="lni lni-cog"></i>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ $content->price }}</p>
                                @php
                                    $total += $content->price;
                                @endphp
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" href="javascript:void(0)"><i class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-12">

                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>{{ $total }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$29.00</span></li>
                                        <li class="last">You Pay<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="checkout.html" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
