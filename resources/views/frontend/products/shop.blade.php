@extends('frontend.layouts.master')

@section('title')
    Shop Page
@endsection

@section('mainContent')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Shop Grid</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)">Shop</a></li>
                        <li>Shop Grid</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">

                    <div class="product-sidebar">

                        <div class="single-widget search">
                            <h3>Search Product</h3>
                            <form action="{{ route('website.shop.search') }}" method="post">
                                @csrf
                                <input type="text" name="product_search" placeholder="Search Here..." required>
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>


                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @forelse ($category_products as $category)
                                    <li>
                                        <a href="{{ route('website.product.category', $category->id) }}">{{ $category->category_name }}
                                        </a><span>({{ $category->products_count }})</span>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>


                        <div class="single-widget range">
                            <h3>Price Range</h3>
                            <input type="range" name="price_value" class="form-range" name="range" step="1"
                                min="10" max="100000" value="10" onchange="rangePrimary.value=value">
                            <div class="range-inner">
                                <label>$</label>
                                <input type="text" id="rangePrimary" placeholder="1" />
                            </div>
                        </div>


                        <div class="single-widget condition">
                            <h3>Filter by Price</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    $50 - $100L (208)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    $100L - $500 (311)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    $500 - $1,000 (485)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                <label class="form-check-label" for="flexCheckDefault4">
                                    $1,000 - $5,000 (213)
                                </label>
                            </div>
                        </div>


                        <div class="single-widget condition">
                            <h3>Filter by Brand</h3>
                            @forelse ($brands as $brand)
                                <ul class="list">
                                    <li class="mt-2">
                                        <a href="{{ route('website.product.brand', $brand->id) }}">
                                            {{ $brand->brand_name }} ({{ $brand->products_count }})
                                        </a>
                                    </li>
                                </ul>
                            @empty
                            @endforelse
                        </div>

                    </div>

                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">Sort by:</label>
                                        <select class="form-control" name="sorting" id="sorting">
                                            <option value="lth">Low - High Price</option>
                                            <option value="htl">High - Low Price</option>
                                            <option value="atoz">A - Z Order</option>
                                            <option value="ztoa">Z - A Order</option>
                                        </select>
                                        <h3 class="total-show-product">Showing: <span>1 - {{ $products->count() }}
                                                items</span></h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            @include('frontend.partials.shop_tab_product')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            //add to cart
            $('body').on('change', '.form-range', function(e) {
                e.preventDefault();
                let price_value = $(this).val();
                $.ajax({
                    url: "{{ route('website.price.range') }}",
                    type: "POST",
                    data: {
                        price_value: price_value,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#nav-tabContent').html(data.tab_product);
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr
                            .responseText);
                    }
                });

            });

            //select box 
            $('body').on('change', '#sorting', function(e) {
                e.preventDefault();
                let sorting = $(this).val();
                $.ajax({
                    url: "{{ route('website.product.sorting') }}",
                    type: "POST",
                    data: {
                        sorting: sorting,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#nav-tabContent').html(data.tab_product);
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
