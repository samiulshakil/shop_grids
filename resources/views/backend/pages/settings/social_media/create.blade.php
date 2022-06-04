@extends('backend.layouts.master')

@section('title', 'Create Social Media')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Create Social Media</div>
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
            {{-- how to use callout --}}
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Social Media Create</h5>
                    </p>
                </div>
            </div>
            <form action="{{ route('admin.settings.socialmedias.store') }}" method="post">
                @csrf
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Basic Info</h5>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Social Media Name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                        </div>
                        @error('name')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" id="url" name="url" placeholder="Social Media URL"
                                class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}"
                                required>
                        </div>
                        @error('url')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="icon">Icon <a class="d-inline" target="_blank"
                                    href="https://lineicons.com/icons">Click Here
                                    For Icon</a></label>
                            <input type="text" id="icon" name="icon" placeholder="Social Media icon"
                                class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}"
                                required>
                        </div>
                        @error('icon')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group mt-4">
                            <label for="status">Status</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" class="custom-control-input mt-2" id="status">
                                <label class="custom-control-label" for="status">Status</label>
                            </div>
                        </div>
                        @error('status')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <button type="submit" class="btn btn-primary mb-2">
                            <span>Create</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
