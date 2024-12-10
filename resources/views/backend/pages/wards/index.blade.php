@extends('backend.layouts.master')

@section('title', 'Ward')

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
                <div>Ward

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.wards.create') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Create Ward
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
                                <th class="text-center">Division Name</th>
                                <th class="text-center">Zila Name</th>
                                <th class="text-center">Upazila Name</th>
                                <th class="text-center">Union Name</th>
                                <th class="text-center">Ward Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wards as $key => $ward)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $ward?->division?->name }}</td>
                                    <td class="text-center">{{ $ward?->zila?->name }}</td>
                                    <td class="text-center">{{ $ward?->upazila?->name }}</td>
                                    <td class="text-center">{{ $ward?->union?->name }}</td>
                                    <td class="text-center">{{ $ward->name }}</td>
                                    <td class="text-center">
                                        @if ($ward->status == 1)
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.wards.edit', $ward->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="deleteData({{ $ward->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $ward->id }}" method="post"
                                            action="{{ route('admin.wards.destroy', $ward->id) }}">
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
