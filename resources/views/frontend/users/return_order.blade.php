@extends('frontend.layouts.master')

@section('mainContent')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Return Order</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('website.home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>Return Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard" style="padding-top:90px; padding-bottom:90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.include.user_sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="main-card mb-3 card">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Payment</th>
                                        <th class="text-center">Return Status</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Delivery Status</th>
                                        <th class="text-center">Return Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr class="text-center">
                                            <td>{{ $order->payment_type }}</td>
                                            @if ($order->return_order == 0)
                                                <td><span class="badge bg-warning">No Return</span></td>
                                            @elseif($order->return_order == 1)
                                                <td><span class="badge bg-primary">Request For Return</span></td>
                                            @elseif($order->return_order == 0)
                                                <td><span class="badge bg-info">Success Return</span></td>
                                            @endif
                                            <td>
                                                {{ $order->amount }}
                                            </td>
                                            <td>
                                                {{ $order->order_date }}
                                            </td>
                                            @if ($order->status == 'Pending')
                                                <td><span class="badge bg-warning">Pending</span></td>
                                            @endif
                                            @if ($order->status == 'Accept Payment')
                                                <td><span class="badge bg-info">Accept Payment</span></td>
                                            @endif
                                            @if ($order->status == 'Progress')
                                                <td><span class="badge bg-info">Progress</span></td>
                                            @endif
                                            @if ($order->status == 'Delivered')
                                                <td><span class="badge bg-success">Delivered</span></td>
                                            @endif
                                            @if ($order->status == 'Cancel')
                                                <td><span class="badge bg-danger">Cancel</span></td>
                                            @endif
                                            @if ($order->return_order == 0)
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        data-bs-whatever="@mdo">Return</button>


                                                    {{-- modal --}}
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">New
                                                                        message</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('order.return.request', $order->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Return
                                                                                Reason:</label>
                                                                            <textarea required class="form-control" name="return_reason" id="message-text"></textarea>
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Return</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @elseif($order->return_order == 1)
                                                <td><span class="badge bg-primary">Request For Return</span></td>
                                            @elseif($order->return_order == 0)
                                                <td><span class="badge bg-info">Success Return</span></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
