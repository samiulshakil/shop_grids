@extends('backend.layouts.master')

@section('title', 'View Orders')

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
        <div class="col-lg-6">
            <div class="card-title text-center text-success">
                <h6>Order Items</h6>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <tbody>
                            <tr>
                                <th class="text-center">Name:</th>
                                <td>{{ $order->shipping->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Payment:</th>
                                <td>{{ $order->payment_type }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Trx Id:</th>
                                <td>{{ $order->transaction_id }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Total:</th>
                                <td>{{ $order->amount }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Date:</th>
                                <td>{{ $order->order_date }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Currency:</th>
                                <td>{{ $order->currency }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">status:</th>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-title text-center text-success">
                <h6>Shipping</h6>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <tbody>
                            <tr>
                                <th class="text-center">Name:</th>
                                <td>{{ $order->shipping->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Email:</th>
                                <td>{{ $order->shipping->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Phone:</th>
                                <td>{{ $order->shipping->phone }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">District:</th>
                                <td>{{ $order->shipping->district->location_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Upazila:</th>
                                <td>{{ $order->shipping->upazila->location_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">State:</th>
                                <td>{{ $order->shipping->state }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Postal:</th>
                                <td>{{ $order->shipping->postal_code }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        @if ($order->status == 'Pending')
            <div class="col-lg-3 mt-4">
                <div class="list-group">
                    <a href="{{ route('admin.paymentorders', $order->id) }}" class="btn btn-info">
                        Accept Payment
                    </a>
                </div>
                <div class="list-group mt-2">
                    <a href="{{ route('admin.cancelorders', $order->id) }}" class="btn btn-danger">
                        Cancel
                    </a>
                </div>
            </div>
        @elseif ($order->status == 'Accept Payment')
            <div class="col-lg-3 mt-4">
                <div class="list-group">
                    <a href="{{ route('admin.progressorders', $order->id) }}" class="btn btn-info">
                        Progress
                    </a>
                </div>
            </div>
        @elseif ($order->status == 'Progress')
            <div class="col-lg-3 mt-4">
                <div class="list-group">
                    <a href="{{ route('admin.deliveredorders', $order->id) }}" class="btn btn-info">
                        Delivered
                    </a>
                </div>
            </div>
        @elseif ($order->status == 'Cancel')
            <div class="col-lg-3 mt-4">
                <div class="list-group">
                    <button class="btn btn-danger">
                        Something Wrong
                    </button>
                </div>
            </div>
        @else
        @endif
        <div class="col-lg-9">
            <div class="card-title text-center text-success">
                <h6>Product Info</h6>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Code</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->orderItems as $item)
                                <tr class="text-center">
                                    <td>{{ $item->product->product_code }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>
                                        <img src="{{ asset($item->product->product_thumbnail) }}" alt=""
                                            style="max-width:50px; max-height:50px;">
                                    </td>
                                    <td>{{ $item->color }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
