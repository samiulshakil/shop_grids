@extends('backend.layouts.master')

@section('title', 'Today Orders')

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
                <div>Today Orders</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('backend.pages.reports.include.sidebar')
        </div>
        <div class="col-lg-9">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Payment</th>
                                <th class="text-center">Transaction</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
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
                                        {{ $order->transaction_id }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->amount }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->order_date }}
                                    </td>
                                    @if ($order->status == 'Pending')
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    @endif
                                    @if ($order->status == 'Accept Payment')
                                        <td><span class="badge badge-info">Accept Payment</span></td>
                                    @endif
                                    @if ($order->status == 'Progress')
                                        <td><span class="badge badge-info">Progress</span></td>
                                    @endif
                                    @if ($order->status == 'Delivered')
                                        <td><span class="badge badge-success">Delivered</span></td>
                                    @endif
                                    @if ($order->status == 'Cancel')
                                        <td><span class="badge badge-danger">Cancel</span></td>
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
