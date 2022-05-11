@extends('backend.layouts.master')

@section('title', 'Backups')

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
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Backups

            </div>
        </div>
        {{-- <div class="page-title-actions">
            <button type="button" onclick="event.preventDefault(); 
            document.getElementById('new-backup-form').submit();" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Create New Backup
            </button>
            <form id="new-backup-form" action="{{route('admin.backups.store')}}" method="POST" class="d-none">
                @csrf
            </form>
        </div>   --}}
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
                            <th class="text-center">File Name</th>
                            <th class="text-center">File Size</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $key => $backup)
                            <tr>
                                <td class="text-center text-muted">{{$key + 1}}</td>
                                <td class="text-center">{{$backup['file_name']}}</td>
                                <td class="text-center">{{$backup['file_size']}}</td>
                                <td class="text-center">{{$backup['created_at'] }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$key}})">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{$key}}" method="post" action="{{ route('admin.backups.destroy', $backup['file_name']) }}">
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
    