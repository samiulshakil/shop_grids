@extends('backend.layouts.master')

@section('title', 'Products')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <style>
        td {
            text-align: center;
        }

    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Product Details

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.products.create') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Create Product
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive" style="padding: 20px;">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Brand Name: </th>
                                <td>{{ $product->brand->brand_name }}</td>
                            </tr>
                            <tr>
                                <th>Category Name: </th>
                                <td>{{ $product->category->category_name }}</td>
                            </tr>
                            @if (!empty($product->subcategory->subcategory_name))
                                <tr>
                                    <th>Sub Category Name: </th>
                                    <td>{{ $product->category->category_name }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>User Name: </th>
                                <td>{{ $product->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Product Name: </th>
                                <td>{{ $product->product_name }}</td>
                            </tr>
                            <tr>
                                <th>Product Code: </th>
                                <td>{{ $product->product_code }}</td>
                            </tr>
                            <tr>
                                <th>Product Quantity: </th>
                                <td>{{ $product->product_qty }}</td>
                            </tr>
                            <tr>
                                <th>Product Tags: </th>
                                <td>{{ $product->product_tags }}</td>
                            </tr>
                            <tr>
                                <th>Product Size: </th>
                                <td>{{ $product->product_size }}</td>
                            </tr>
                            <tr>
                                <th>Product Color: </th>
                                <td>{{ $product->product_color }}</td>
                            </tr>
                            <tr>
                                <th>Product Selling Price: </th>
                                <td>{{ $product->selling_price }}</td>
                            </tr>
                            <tr>
                                <th>Product Discount Price: </th>
                                <td>{{ $product->discount_price }}</td>
                            </tr>
                            <tr>
                                <th>Product Thumbnail: </th>
                                <td><img src="{{ asset($product->product_thumbnail) }}" width="50px;" height="50px" />
                                </td>
                            </tr>
                            <tr>
                                <th>Product Image One: </th>
                                <td><img src="{{ asset($product->image_one) }}" width="50px;" height="50px" /></td>
                            </tr>
                            <tr>
                                <th>Product Image Two: </th>
                                <td><img src="{{ asset($product->image_two) }}" width="50px;" height="50px" /></td>
                                </td>
                            </tr>
                            <tr>
                                <th>Product Image Three: </th>
                                <td><img src="{{ asset($product->image_three) }}" width="50px;" height="50px" /></td>
                                </td>
                            </tr>
                            <tr>
                                <th>Product Short Description: </th>
                                <td>{{ $product->short_description }}</td>
                            </tr>
                            <tr>
                                <th>Product Long Description: </th>
                                <td>{{ $product->long_description }}</td>
                            </tr>
                            <tr>
                                <th>Product Key Features: </th>
                                <td>{{ $product->key_features }}</td>
                            </tr>
                            <tr>
                                <th>Product Specifications: </th>
                                <td>{{ $product->specifications }}</td>
                            </tr>
                            <tr>
                                <th>Product Hot Deals: </th>
                                <td>{{ $product->hot_deals == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Product Featured: </th>
                                <td>{{ $product->featured == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Product Speacial Offer: </th>
                                <td>{{ $product->special_offer == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Product Speacial Deals: </th>
                                <td>{{ $product->special_deals == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Product Creator: </th>
                                <td>{{ $product->product_creator }}</td>
                            </tr>
                            <tr>
                                <th>Product Created At: </th>
                                <td>{{ $product->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endpush
