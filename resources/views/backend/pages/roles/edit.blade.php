@extends('backend.layouts.master')

@section('title', 'Role Edit')

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
            <div>Roles

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.roles.index')}}" class="mr-3 btn btn-danger">
                <i class="fas fa-arrow-circle-left"></i>
                Back
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card p-4">
            <form action="{{route('admin.roles.update', $role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <h5 class="card-title text-center">Edit Role</h5>
                    <label for="name">Role Name</label>
                    <input type="text" id="name" name="name" value="{{$role->name}}" placeholder="Enter Role Name" class="form-control">

                    @error('name')
                        <p class="p-2">
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            </p>
                    @enderror

                    <div class="text-center mt-3">
                        <strong>Manage permissions for role</strong>
                        @error('permissions')
                            <p class="p-2">
                                <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror
                    </div>
                
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="select-all">
                        <label class="custom-control-label" for="select-all">Select All</label>
                    </div>
                </div>
                @forelse($modules->chunk(2) as $key => $chunks)
                <div class="form-row">
                    @foreach($chunks as $key=>$module)
                        <div class="col">
                            <h5>Module: {{ $module->name }}</h5>
                            @foreach($module->permissions as $key=>$permission)
                                <div class="mb-3 ml-4">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input"
                                               id="permission-{{ $permission->id }}"
                                               value="{{ $permission->id }}"
                                               name="permissions[]"
                                            @foreach($role->permissions as $rPermission) 
                                                {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                            @endforeach>
                                        <label class="custom-control-label"for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="row">
                    <div class="col text-center">
                        <strong>No Module Found.</strong>
                    </div>
                </div>
            @endforelse
            <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                <i class="fas fa-redo"></i>
                <span>Reset</span>
            </button>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                <span>Update</span>
            </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

<script type="text/javascript">
    // Listen for click on toggle checkbox
    $('#select-all').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });
</script>

@endpush
    