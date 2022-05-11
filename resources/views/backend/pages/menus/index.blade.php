@extends('backend.layouts.master')

@section('title', 'Menus')

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
                <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Menus</div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.menus.create')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Create Menu
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
                            <th class="text-center">Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $key => $menu)
                            <tr>
                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $menu->name }}</div>
                                                <div class="widget-subheading opacity-7">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $menu->description }}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.menus.builder', $menu->id)}}" class="btn btn-success btn-sm">
                                        <i class="fas fa-list-ul"></i>
                                        <span>Builder</span>
                                    </a>

                                    <a href="{{route('admin.menus.edit', $menu->id)}}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                    @if ($menu->deletable == true)
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$menu->id}})">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{$menu->id}}" method="post" action="{{ route('admin.menus.destroy', $menu->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
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
    