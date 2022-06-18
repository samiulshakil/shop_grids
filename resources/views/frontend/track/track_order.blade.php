@extends('frontend.layouts.master')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap');

        #main-content {
            padding: 30px;
            border-radius: 15px;
        }

        #main-content .h5,
        #main-content .text-uppercase {
            font-weight: 600;
            margin-bottom: 0;
        }

        #main-content .h5+div {
            font-size: 0.9rem;
        }

        #main-content .box {
            padding: 10px;
            border-radius: 6px;
            width: 170px;
            height: 90px;
        }

        #main-content .box img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        #main-content .box .tag {
            font-size: 0.9rem;
            color: #000;
            font-weight: 500;
        }

        #main-content .box .number {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .order {
            padding: 10px 30px;
            min-height: 150px;
        }

        .order .order-summary {
            height: 100%;
        }

        .order .blue-label {
            background-color: #aeaeeb;
            color: #0046dd;
            font-size: 0.9rem;
            padding: 0px 3px;
        }

        .order .green-label {
            background-color: #a8e9d0;
            color: #008357;
            font-size: 0.9rem;
            padding: 0px 3px;
        }

        .order .fs-8 {
            font-size: 0.85rem;
        }

        .order .rating img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        .order .rating .fas,
        .order .rating .far {
            font-size: 0.9rem;
        }

        .order .rating .fas {
            color: #daa520;
        }

        .order .status {
            font-weight: 600;
        }

        .order .btn.btn-primary {
            background-color: #fff;
            color: #4e2296;
            border: 1px solid #4e2296;
        }

        .order .btn.btn-primary:hover {
            background-color: #4e2296;
            color: #fff;
        }

        .order .progressbar-track {
            margin-top: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .order .progressbar-track .progressbar {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-left: 0rem;
        }

        .order .progressbar-track .progressbar li {
            font-size: 1.5rem;
            border: 1px solid #333;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: #dddddd;
            z-index: 100;
            position: relative;
        }

        .order .progressbar-track .progressbar li.green {
            border: 1px solid #007965;
            background-color: #d5e6e2;
        }

        .order .progressbar-track .progressbar li::after {
            position: absolute;
            font-size: 0.9rem;
            top: 50px;
            left: 0px;
        }

        #tracker {
            position: absolute;
            border-top: 1px solid #bbb;
            width: 100%;
            top: 25px;
        }

        #step-1::after {
            content: 'Placed';
        }

        #step-2::after {
            content: 'Accepted';
            left: -10px;
        }

        #step-3::after {
            content: 'Packed';
        }

        #step-4::after {
            content: 'Shipped';
        }

        #step-5::after {
            content: 'Delivered';
            left: -10px;
        }



        /* Backgrounds */
        .bg-purple {
            background-color: #55009b;
        }

        .bg-light {
            background-color: #f0ecec !important;
        }

        .green {
            color: #007965 !important;
        }

        /* Media Queries */
        @media(max-width: 1199.5px) {
            nav ul li {
                padding: 0 10px;
            }
        }

        @media(max-width: 500px) {
            .order .progressbar-track .progressbar li {
                font-size: 1rem;
            }

            .order .progressbar-track .progressbar li::after {
                font-size: 0.8rem;
                top: 35px;
            }

            #tracker {
                top: 20px;
            }
        }

        @media(max-width: 440px) {
            #main-content {
                padding: 20px;
            }

            .order {
                padding: 20px;
            }

            #step-4::after {
                left: -5px;
            }
        }

        @media(max-width: 395px) {
            .order .progressbar-track .progressbar li {
                font-size: 0.8rem;
            }

            .order .progressbar-track .progressbar li::after {
                font-size: 0.7rem;
                top: 35px;
            }

            #tracker {
                top: 15px;
            }

            .order .btn.btn-primary {
                font-size: 0.85rem;
            }
        }

        @media(max-width: 355px) {
            #main-content {
                padding: 15px;
            }

            .order {
                padding: 10px;
            }
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-lg-12 my-lg-0 my-1">
                                    <div id="main-content" class="bg-white border">
                                        <div class="order my-3 bg-light">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="progressbar-track">
                                                        <ul class="progressbar">
                                                            @if ($order->status == 'Pending')
                                                                <li id="step-1" class="text-mute">
                                                                    <span class="fas fa-gift"></span>
                                                                </li>
                                                                <li id="step-2" class="text-muted ">
                                                                    <span class="fas fa-check"></span>
                                                                </li>
                                                                <li id="step-4" class="text-muted">
                                                                    <span class="fas fa-truck"></span>
                                                                </li>
                                                                <li id="step-5" class="text-muted">
                                                                    <span class="fas fa-box-open"></span>
                                                                </li>
                                                            @endif
                                                            @if ($order->status == 'Accept Payment')
                                                                <li id="step-1" class="text-mute green">
                                                                    <span class="fas fa-gift"></span>
                                                                </li>
                                                                <li id="step-2" class="text-muted green">
                                                                    <span class="fas fa-check"></span>
                                                                </li>
                                                                <li id="step-4" class="text-muted">
                                                                    <span class="fas fa-truck"></span>
                                                                </li>
                                                                <li id="step-5" class="text-muted">
                                                                    <span class="fas fa-box-open"></span>
                                                                </li>
                                                            @endif
                                                            @if ($order->status == 'Progress')
                                                                <li id="step-1" class="text-mute green">
                                                                    <span class="fas fa-gift"></span>
                                                                </li>
                                                                <li id="step-2" class="text-muted green">
                                                                    <span class="fas fa-check"></span>
                                                                </li>
                                                                <li id="step-4" class="text-muted green">
                                                                    <span class="fas fa-truck"></span>
                                                                </li>
                                                                <li id="step-5" class="text-muted">
                                                                    <span class="fas fa-box-open"></span>
                                                                </li>
                                                            @endif
                                                            @if ($order->status == 'Delivered')
                                                                <li id="step-1" class="text-mute green">
                                                                    <span class="fas fa-gift"></span>
                                                                </li>
                                                                <li id="step-2" class="text-muted green">
                                                                    <span class="fas fa-check"></span>
                                                                </li>
                                                                <li id="step-4" class="text-muted green">
                                                                    <span class="fas fa-truck"></span>
                                                                </li>
                                                                <li id="step-5" class="text-muted green">
                                                                    <span class="fas fa-box-open"></span>
                                                                </li>
                                                            @endif

                                                        </ul>
                                                        <div id="tracker"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
