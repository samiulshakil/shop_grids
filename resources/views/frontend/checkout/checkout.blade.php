@extends('frontend.layouts.master')

@section('title')
    Checkout Page
@endsection

@push('css')
    <style>
        .payment_type {
            display: inline-block;
            margin-right: 20px;
        }

        .payment_img {
            max-width: 60px;
            max-height: 60px;
        }
    </style>
@endpush

@section('mainContent')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">checkout</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <ul id="">
                            <li>
                                <h6 class="title">Product Info
                                </h6>
                                <div class="col-md-12">
                                    <div class="cart-list-head">

                                        <div class="cart-list-title  text-center">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-12">
                                                    <p>Image</p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12">
                                                    <p>Name</p>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-12">
                                                    <p>Quantity</p>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-12">
                                                    <p>Price</p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12">
                                                    <p>Total</p>
                                                </div>
                                            </div>
                                        </div>

                                        @forelse ($carts as $content)
                                            <div class="cart-single-list text-center hide-{{ $content->rowId }}">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-2 col-md-2 col-12">
                                                        <a href="#!"><img src="{{ asset($content->options['image']) }}"
                                                                alt="#" style="max-height: 100px; max-width: 100px;"></a>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-12">
                                                        <h5 class="product-name"><a href="#!">{{ $content->name }}</a>
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-12">
                                                        <h5 class="product-name"><a href="#!">{{ $content->qty }}</a>
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-12">
                                                        <p class="total_price{{ $content->id }}">
                                                            ${{ $content->price }}
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-12 text-center">
                                                        <p class="total_price{{ $content->id }}">
                                                            ${{ $content->price * $content->qty }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse


                                    </div>
                                </div>
                                <h6 class="title mt-3">Shipping
                                    Address</h6>
                                <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                    aria-labelledby="headingThree" data-bs-parent="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>Name</label>
                                                <div class="row">
                                                    <div class="col-md-12 form-input form">
                                                        <input type="text" value="{{ Auth::user()->name }}" readonly
                                                            placeholder="First Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Email Address</label>
                                                <div class="form-input form">
                                                    <input type="text" value="{{ Auth::user()->email }}" readonly
                                                        placeholder="Email Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Phone Number</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Phone Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>Note</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Note">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>District</label>
                                                <div class="select-items">
                                                    <select class="form-control" id="district_id"
                                                        onchange="upazilaList(this.value)" name="district_id">
                                                        @forelse ($districts as $district)
                                                            <option value="{{ $district->id }}">
                                                                {{ $district->location_name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Upazila</label>
                                                <div class="select-items">
                                                    <select class="form-control" name="upazila_id" id="upazila_id">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>State/Region</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Postal Code</label>
                                                <div class="form-input form">
                                                    <input type="number" placeholder="Postal Code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-payment-option">
                                                <h6 class="heading-6 font-weight-400 payment-title">Select Delivery
                                                    Option</h6>
                                                <div class="payment-option-wrapper">
                                                    <div class="single-payment-option">
                                                        <input type="radio" name="shipping" checked id="shipping-1">
                                                        <label for="shipping-1">
                                                            <img src="{{ asset('frontend/assets/images/shipping/shipping-1.png') }}"
                                                                alt="Sipping">
                                                            <p>Inside Dhaka</p>
                                                            <span class="price">$1</span>
                                                        </label>
                                                    </div>
                                                    <div class="single-payment-option">
                                                        <input type="radio" name="shipping" id="shipping-2">
                                                        <label for="shipping-2">
                                                            <img src="{{ asset('frontend/assets/images/shipping/shipping-2.png') }}"
                                                                alt="Sipping">
                                                            <p>Outside Dhaka</p>
                                                            <span class="price">$3</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </li>
                            <li>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        @if (Session::has('coupon'))
                        @else
                            <div class="checkout-sidebar-coupon">
                                <p>Appy Coupon to get discount!</p>
                                <div class="coupon">
                                    <form action="#" class="couponApply" method="post">
                                        @csrf
                                        <input name="code" id="code" placeholder="Enter Your Coupon" required>
                                        <div class="button mt-3">
                                            <button class="btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                        @endif
                    </div>
                    <div class="checkout-sidebar-price-table mt-30">
                        <h5 class="title">Pricing Table</h5>
                        @if (Session::has('coupon'))
                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">Subotal Price:</p>
                                    <p class="price">${{ $cartTotal }}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">Coupon Code:</p>
                                    <p class="price">{{ session()->get('coupon')['code'] }}
                                        ({{ session()->get('coupon')['value'] }})</p>
                                </div>
                                <div class="total-price discount">
                                    <p class="value">Discount Amount:</p>
                                    <p class="price">${{ session()->get('coupon')['discount_amount'] }}</p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Grand Total:</p>
                                    <p class="price">${{ session()->get('coupon')['total_amount'] }}</p>
                                </div>
                            </div>
                        @else
                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">Subotal Price:</p>
                                    <p class="price">${{ $cartTotal }}</p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Grand Total:</p>
                                    <p class="price">${{ $cartTotal }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="checkout-sidebar-price-table mt-30">
                        <h5 class="title">Select Payment Method</h5>
                        <div class="payment_radio mt-5">
                            <form action="#">
                                <p class="payment_type">
                                    <input type="radio" id="test1" name="radio-group" checked>
                                    <label for="test1"><img class="payment_img"
                                            src="{{ asset('frontend/assets/images/payment/master.png') }}" for="test1"
                                            alt=""></label>
                                </p>
                                <p class="payment_type">
                                    <input type="radio" id="test2" name="radio-group">
                                    <label for="test2"><img class="payment_img"
                                            src="{{ asset('frontend/assets/images/payment/paypal.png') }}" alt="">
                                    </label>
                                </p>
                                <p class="payment_type">
                                    <input type="radio" id="test3" name="radio-group">
                                    <label for="test3"><img class="payment_img"
                                            src="{{ asset('frontend/assets/images/payment/visa.png') }}" for="test3"
                                            alt="">
                                    </label>
                                </p>

                                <div class="single-form form-default button mt-4">
                                    <button class="btn">pay now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        //get upazila by dependenci select box
        function upazilaList(district_id) {
            if (district_id) {
                $.ajax({
                    url: "{{ route('upazila.list') }}",
                    type: "POST",
                    data: {
                        district_id: district_id,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#upazila_id').html('');
                        $('#upazila_id').html(data);
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                    }
                });
            }

        }

        $(document).ready(function() {
            //Coupon Apply
            $('body').on('submit', '.couponApply', function(e) {
                e.preventDefault();
                let code = $('#code').val();
                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        code: code,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        flashMessage(data.status, data.message);
                        if (data.status == 'success') {
                            $('.coupon').hide();
                        }
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                            .responseText);
                    }
                });

            });
        });
    </script>
@endpush