@extends('frontend.layouts.master')

@section('title')
    Stripe Payment
@endsection
@push('css')
    <style>
        /**
                                * The CSS shown here will not be introduced in the Quickstart guide, but shows
                                * how you can use CSS to style your Element's container.
                                */
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endpush
@section('mainContent')
    @php
    $carts = Cart::content();
    @endphp
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
                        <li>Stripe</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
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
                                        @if (Session::has('coupon'))
                                            <div class="checkout-sidebar-price-table mt-30" id="couponCalField">
                                                <h5 class="title">Pricing Table</h5>
                                                <div class="sub-total-price with_coupon">
                                                    <div class="total-price">
                                                        <p class="value">Subotal Price:</p>
                                                        <p class="price subtotal">${{ Cart::subtotal() }}</p>
                                                    </div>
                                                    <div class="total-price shipping">
                                                        <p class="value">Coupon Code:</p>
                                                        <p class="price"><span
                                                                class="code">${{ Session::get('coupon')['code'] }}</span>
                                                            <span
                                                                class="code_value">(${{ Session::get('coupon')['value'] }})</span>
                                                        </p>
                                                    </div>
                                                    <div class="total-price discount">
                                                        <p class="value">Discount Amount:</p>
                                                        <p class="price discount_amount">
                                                            ${{ Session::get('coupon')['discount_amount'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="total-payable">
                                                    <div class="payable-price">
                                                        <p class="value">Grand Total:</p>
                                                        <p class="price total_amount">
                                                            ${{ Session::get('coupon')['total_amount'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="checkout-sidebar-price-table mt-30" id="couponCalField">
                                                <h5 class="title">Pricing Table</h5>
                                                <div class="sub-total-price">
                                                    <div class="total-price">
                                                        <p class="value">Subotal:</p>
                                                        <p class="price">${{ Cart::subtotal() }}</p>
                                                    </div>
                                                </div>
                                                <div class="sub-total-price">
                                                    <div class="total-price">
                                                        <p class="value">Grand Total:</p>
                                                        <p class="price">${{ Cart::subtotal() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h4 class="text-center" style="margin-bottom: 10px">Pay Now</h4>
                    <form action="{{ route('stripe.order') }}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">

                            <label for="card-element" style="margin-bottom: 10px;">Credit or Debit card</label>

                            <input type="hidden" name="name" value="{{ $data['name'] }}">
                            <input type="hidden" name="email" value="{{ $data['email'] }}">
                            <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                            <input type="hidden" name="address" value="{{ $data['address'] }}">
                            <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                            <input type="hidden" name="upazila_id" value="{{ $data['upazila_id'] }}">
                            <input type="hidden" name="state" value="{{ $data['state'] }}">
                            <input type="hidden" name="postal_code" value="{{ $data['postal_code'] }}">


                            <div id="card-element"></div>

                            <div id="card-errors" role="alert"></div>

                        </div>
                        <br>
                        <button class="btn btn-primary">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe(
            'pk_test_51LB1RFIIxPDrK9xgjsvziyzDROHw8KflXPfLRUVYjjMLqQkC013kpw41gBe5qIGOmZFAw8h76zKhQWulgOBOx2iY00CyECpKzd'
        );
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>
@endpush
