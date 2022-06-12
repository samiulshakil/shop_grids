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
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>Wishlists</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="shopping-cart section">
        <div class="show_carts">
            <div class="container">
                <div class="cart-list-head">

                    <div class="cart-list-title  text-center">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-12">
                                <p>Image</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-12">
                                <p>Name</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-12">
                                <p>Quantity</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-12">
                                <p>Price</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <p>Delete</p>
                            </div>
                        </div>
                    </div>

                    @forelse ($wishlists as $wishlist)
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-3 col-12">
                                    <a href="#!"><img style="max-width: 150px; max-height:150px"
                                            src="{{ asset($wishlist->product->product_thumbnail) }}" alt="#"></a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-12">
                                    <h5 class="product-name text-center"><a
                                            href="#!">{{ $wishlist->product->product_name }}</a>
                                    </h5>
                                </div>
                                <div class="col-lg-2 col-md-3 col-12">
                                    <h5 class="product-name text-center"><a
                                            href="#!">{{ $wishlist->product->product_qty }}</a>
                                    </h5>
                                </div>
                                <div class="col-lg-2 col-md-3 col-12">
                                    <h5 class="product-name text-center"><a
                                            href="#!">{{ $wishlist->product->discount_price }}</a>
                                    </h5>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12 text-center">
                                    <a onclick="deleteData({{ $wishlist->id }})" class="remove-item text-center"
                                        href="javascript:void(0)"><i class="lni lni-close "></i></a>
                                    <form id="delete-form-{{ $wishlist->id }}" method="post"
                                        action="{{ route('wish.destory', $wishlist->id) }}">
                                        @csrf
                                        <input type="hidden" value="{{ $wishlist->product->id }}" name="product_id">
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse


                </div>
            </div>

        </div>
    </div>
@endsection
