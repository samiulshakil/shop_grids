@extends('backend.layouts.master')

@section('title', 'Coupons')

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
                <i class="pe-7s-arc icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Coupons

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.coupons.create')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Create Coupon
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
                            <th class="text-center">Coupon Code</th>
                            <th class="text-center">Coupon Type</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Expire Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $key => $coupon)
                            <tr>
                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                <td class="text-center">{{ $coupon->code}}</td>
                                <td class="text-center">{{ $coupon->type }}</td>
                                <td class="text-center">{{ $coupon->value }}</td>
                                <td class="text-center">{{ $coupon->expire }}</td>
                                <td class="text-center">
                                    @if ($coupon->status == 1)
                                        <div class="badge badge-success">Active</div>
                                    @else
                                        <div class="badge badge-danger">Inactive</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.coupons.edit', $coupon->id)}}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$coupon->id}})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="delete-form-{{$coupon->id}}" method="post" action="{{ route('admin.coupons.destroy', $coupon->id) }}">
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
        } );
    </script>
@endpush
    