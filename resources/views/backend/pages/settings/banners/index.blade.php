@extends('backend.layouts.master')

@section('title', 'Banners')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Website Banner Media</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.dashboard') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('backend.pages.settings.sidebar')
            <label>Website Settings</label>
            @include('backend.pages.settings.website_sidebar')
        </div>
        <div class="col-md-9">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Banner</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $key => $banner)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset($banner->banner_image) }}" alt="Banner" height="100px"
                                            width="100px">
                                    </td>
                                    <td class="text-center">{{ $banner->banner_title }}</td>
                                    <td class="text-center">{{ $banner->banner_price }}</td>
                                    <td class="text-center">
                                        @if ($banner->status == 1)
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.settings.banners.create') }}"
                                            class="btn btn-primary btn-sm" title="Create Banner">
                                            <i class="fas fa-plus" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.settings.banners.edit', $banner->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($banner->status == 1)
                                            <a href="{{ route('admin.settings.banners.inactive', $banner->id) }}"
                                                class="btn btn-sm btn-danger edit-icon" title="inactive"> <i
                                                    class="fa fa-arrow-down"></i></a>
                                        @else
                                            <a href="{{ route('admin.settings.banners.active', $banner->id) }}"
                                                class="btn btn-sm btn-success edit-icon" title="active now data"> <i
                                                    class="fa fa-arrow-up"></i></a>
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
