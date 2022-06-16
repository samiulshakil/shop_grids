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
                                <h6 class="title mt-3">Shipping Address</h6>
                                <section class="checkout-steps-form-content collapse show" id="collapseThree">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <form action="{{ route('payment.process') }}" method="POST">
                                                    @csrf
                                                    <label>Name</label>
                                                    <div class="row">
                                                        <div class="col-md-12 form-input form">
                                                            <input type="text" name="name"
                                                                value="{{ Auth::user()->name }}" placeholder="Your Name">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Email Address</label>
                                                <div class="form-input form">
                                                    <input type="text" name="email" value="{{ Auth::user()->email }}"
                                                        readonly placeholder="Email Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Phone Number</label>
                                                <div class="form-input form">
                                                    <input type="text" name="phone" placeholder="Phone Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>Address</label>
                                                <div class="form-input form">
                                                    <input type="text" name="address" placeholder="Address">
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
                                                    <input type="text" name="state" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Postal Code</label>
                                                <div class="form-input form">
                                                    <input type="number" name="postal_code" placeholder="Postal Code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-30">
                                        <h5 class="title">Select Payment Method</h5>
                                        <div class="payment_radio mt-5">
                                            <p class="payment_type">
                                                <input type="radio" id="test1" name="payment" value="stripe"
                                                    name="radio-group">
                                                <label for="test1"><img class="payment_img"
                                                        src="{{ asset('frontend/assets/images/payment/master.png') }}"
                                                        for="test1" alt=""></label>
                                            </p>
                                            <p class="payment_type">
                                                <input type="radio" id="test2" name="payment" value="paypal"
                                                    name="radio-group">
                                                <label for="test2"><img class="payment_img"
                                                        src="{{ asset('frontend/assets/images/payment/paypal.png') }}"
                                                        alt="">
                                                </label>
                                            </p>
                                            <p class="payment_type">
                                                <input type="radio" id="test3" name="payment" value="visa"
                                                    name="radio-group">
                                                <label for="test3"><img class="payment_img"
                                                        src="{{ asset('frontend/assets/images/payment/visa.png') }}"
                                                        for="test3" alt="">
                                                </label>
                                            </p>

                                            <div class="single-form form-default button mt-4">
                                                <button type="submit" class="btn">pay now</button>
                                            </div>
                                            </form>
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
                            <div class="checkout-sidebar-coupon" id="coupon">
                                <p>Appy Coupon to get discount!</p>
                                <div>
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
                    <div class="checkout-sidebar-price-table mt-30" id="couponCalField">

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
            //coupon calculation start
            function couponCalculation() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('coupon.calculation') }}",
                    dataType: 'json',
                    success: function(data) {
                        if (data.total) {
                            $('#couponCalField').html(`
                        <h5 class="title">Pricing Table</h5>
                            <div class="sub-total-price without_coupon">
                                <div class="total-price">
                                    <p class="value">Subotal Price:</p>
                                    <p class="price">${data.total}</p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Grand Total:</p>
                                    <p class="price">${data.total}</p>
                                </div>
                            </div>
							`)
                        } else {
                            $('#couponCalField').html(`
                        <h5 class="title">Pricing Table</h5>
                            <div class="sub-total-price with_coupon">
                                <div class="total-price">
                                    <p class="value">Subotal Price:</p>
                                    <p class="price subtotal">${data.subtotal}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">Coupon Code:</p>
                                    <p class="price"><span
                                            class="code">${data.code}</span>
                                        <span class="code_value">(${ data.coupon_discount })</span>
                                    </p>
                                </div>
                                <div class="total-price discount">
                                    <p class="value">Discount Amount:</p>
                                    <p class="price discount_amount">${data.discount_amount}
                                    </p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Grand Total:</p>
                                    <p class="price total_amount">${data.total_amount}</p>
                                </div>
                            </div>
						`)
                        }
                    }
                });
            }

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
                            couponCalculation();
                            $('#coupon').hide();
                        }
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                            .responseText);
                    }
                });

            });
            couponCalculation();
        });
    </script>
@endpush
