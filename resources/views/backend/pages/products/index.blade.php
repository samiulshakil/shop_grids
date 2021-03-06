@extends('backend.layouts.master')

@section('title', 'Products')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <style>
        .dataTables_length {
            padding-top: 1rem;
            padding-left: 1rem;
        }

        .dataTables_filter {
            padding-top: 1rem;
            padding-right: 1rem;
        }

        .dataTables_info {
            padding-left: 1rem;
            padding-bottom: 1rem;
        }

        .dataTables_paginate {
            padding-right: 1rem;
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
                <div>Product

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
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Brand</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Thumbnail</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                    <td class="text-center text-muted">{{ $product->product_name }}</td>
                                    <td class="text-center">{{ $product->brand->brand_name }}</td>
                                    <td class="text-center">{{ $product->category->category_name }}</td>
                                    <td class="text-center">{{ $product->product_qty }}</td>
                                    <td class="text-center">{{ $product->discount_price }}</td>
                                    <td class="text-center">
                                        <img width="40" class="rounded-circle"
                                            src="{{ $product->product_thumbnail != null ? asset($product->product_thumbnail) : 'https://via.placeholder.com/200x200' }}"
                                            alt="Avatar">
                                    </td>
                                    <td class="text-center">
                                        @if ($product->product_status == 1)
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($product->product_status == 1)
                                            <a href="{{ route('admin.products.inactive', $product->product_slug) }}"
                                                class="btn btn-sm btn-danger edit-icon" title="inactive"> <i
                                                    class="fa fa-arrow-down"></i></a>
                                        @else
                                            <a href="{{ route('admin.products.active', $product->product_slug) }}"
                                                class="btn btn-sm btn-success edit-icon" title="active now data"> <i
                                                    class="fa fa-arrow-up"></i></a>
                                        @endif
                                        <a href="{{ route('admin.products.edit', $product->product_slug) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.products.show', $product->product_slug) }}"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="deleteData({{ $product->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-form-{{ $product->id }}" method="post"
                                            action="{{ route('admin.products.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
