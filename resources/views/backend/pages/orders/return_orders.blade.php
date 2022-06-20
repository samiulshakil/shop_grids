@extends('backend.layouts.master')

@section('title', 'All Orders')

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
                    <i class="pe-7s-gift icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Orders</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('backend.pages.orders.include.sidebar')
        </div>
        <div class="col-lg-9">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Payment</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Approve</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading text-center">{{ $order->payment_type }}
                                                    </div>
                                                    <div class="widget-subheading opacity-7">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ $order->amount }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->order_date }}
                                    </td>
                                    @if ($order->return_order == 1)
                                        <td><span class="badge badge-primary">Return Requested</span></td>
                                    @elseif($order->return_order == 2)
                                        <td><span class="badge badge-success">Returned Approved</span></td>
                                    @endif
                                    @if ($order->return_order == 1)
                                        <td><a class="btn btn-sm btn-primary"
                                                href="{{ route('admin.return.orders.approve', $order->id) }}">Approve</a>
                                        </td>
                                    @elseif($order->return_order == 2)
                                        <td><span class="badge badge-success">Returned Approved</span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('admin.view.orders', $order->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i>
                                            <span>View</span>
                                        </a>
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
