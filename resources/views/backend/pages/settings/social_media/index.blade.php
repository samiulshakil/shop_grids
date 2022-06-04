@extends('backend.layouts.master')

@section('title', 'Social Media')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Website Social Media</div>
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Url</th>
                                <th class="text-center">Icon</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socials as $key => $social)
                                <tr>
                                    <td class="text-center">{{ $social->name }}</td>
                                    <td class="text-center">{{ $social->url }}</td>
                                    <td class="text-center">{{ $social->icon }}</td>
                                    <td class="text-center">
                                        @if ($social->status == 1)
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.settings.socialmedias.create') }}"
                                            class="btn btn-primary btn-sm" title="Create Social Media">
                                            <i class="fas fa-plus" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.settings.socialmedias.edit', $social->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($social->status == 1)
                                            <a href="{{ route('admin.settings.socialmedias.inactive', $social->id) }}"
                                                class="btn btn-sm btn-danger edit-icon" title="inactive"> <i
                                                    class="fa fa-arrow-down"></i></a>
                                        @else
                                            <a href="{{ route('admin.settings.socialmedias.active', $social->id) }}"
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
