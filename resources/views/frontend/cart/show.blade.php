@extends('frontend.layouts.master')

@push('css')
    <style>
        button.value-button.increase {
            border: 1px solid #fcfcfc;
            padding: 10px;
            background: #fff;
        }

        button.value-button.decrease {
            border: 1px solid #fcfcfc;
            padding: 10px;
            background: #fff;
        }

        .increase {
            display: inline-block;
        }

        .decrease {
            display: inline-block;
        }

        .value-button:hover {
            cursor: pointer;
        }

        input#number {
            text-align: center;
            border: 1px solid #ddd;
            margin: 0px;
            width: 60px;
            height: 40px;
            background: white;
        }

        i.lni.lni-circle-plus {
            margin-left: 10px;
            font-size: 18px;
        }

        i.lni.lni-circle-minus {
            margin-right: 10px;
            font-size: 18px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .lni.lni-cog:hover {
            cursor: pointer;
        }
    </style>
@endpush

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
        <div class="show_carts">
            @include('frontend.partials.show_cart')
        </div>
    </div>
@endsection

@push('js')
    <script>
        function increaseValue(id) {
            let qty = parseInt($('.number' + id).val())
            var value = parseInt($('.number' + id).val());
            value = isNaN(value) ? 0 : value;
            value++;
            $('.number' + id).val(value);
            if (value == 6) {
                alert('Sorry, Maximum 5 Product You can Add');
                parseInt($('.number' + id).val(5))
                $('.increase-button' + id).attr('disabled', true);
            } else {
                $('.decrease-button' + id).attr('disabled', false);
            }
        }

        function decreaseValue(id) {
            var value = parseInt($('.number' + id).val());
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $('.number' + id).val(value);

            if (value == 0) {
                alert('Sorry, Quantity Must at least one');
                parseInt($('.number' + id).val(1))
                $('.decrease-button' + id).attr('disabled', true);
            } else {
                $('.increase-button' + id).attr('disabled', false);
            }
        }

        $(document).ready(function() {
            //plus button
            $('body').on('click', '#plus', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let qty = parseInt($('.number' + id).val());
                if (qty > 0) {
                    let price = parseInt($('.price' + id).val());
                    let total_price = qty * price;
                    $('.total_price' + id).text('$' + total_price);
                }
            });

            //minus button
            $('body').on('click', '#minus', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let qty = parseInt($('.number' + id).val());
                if (qty > 0) {
                    let price = parseInt($('.price' + id).val());
                    let total_price = qty * price;
                    $('.total_price' + id).text('$' + total_price);
                }
            });

            //update cart 
            $('body').on('click', '.updateCart', function(e) {
                e.preventDefault();
                let id = $('#plus').attr('data-id');
                let rowId = $(this).attr('row-id');
                let qty = parseInt($('.number' + id).val());
                if (rowId) {
                    $.ajax({
                        url: "{{ route('cart.update') }}",
                        type: "POST",
                        data: {
                            rowId: rowId,
                            qty: qty,
                            _token: _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            flashMessage(data.status, data.message);
                            $('.sub_total').text('$' + data.subtotal);
                            $('.sub_total_input').val(data.subtotal);
                        },
                        error: function(xhr, ajaxOption, thrownError) {
                            console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                                .responseText);
                        }
                    });
                }

            });

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

            //Delete cart 
            $('body').on('click', '.deleteCart', function(e) {
                e.preventDefault();
                let rowId = $(this).attr('row-id');
                if (rowId) {
                    $.ajax({
                        url: "{{ route('cart.delete') }}",
                        type: "POST",
                        data: {
                            rowId: rowId,
                            _token: _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            flashMessage(data.status, data.message);
                            // $('.hide-' + rowId).hide();
                            $('.show_carts').html(data.cart_show);
                            $('.total-items').html(data.cartcount);
                            $('.cart-items').html(data.cart_popup);
                        },
                        error: function(xhr, ajaxOption, thrownError) {
                            console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                                .responseText);
                        }
                    });
                }

            });
        });
    </script>
@endpush
