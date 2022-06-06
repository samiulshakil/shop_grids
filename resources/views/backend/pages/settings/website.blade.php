@extends('backend.layouts.master')

@section('title', 'Website General Setting')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Website General Settings</div>
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
                    <h5 class="card-title">How To Use:</h5>
                    <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code>
                    </p>
                </div>
            </div>
            <form action="{{ route('admin.settings.website.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Basic Info</h5>
                        <div class="form-group">
                            <label for="website_logo">Site Logo (Only image is allowed)</label>
                            <input type="file" data-allowed-file-extensions="jpg jpeg png svg webp gif"
                                class="dropify form-control @error('website_logo') is-invalid @enderror" name="website_logo"
                                data-default-file="{{ setting('website_logo') != null ? Storage::url(setting('website_logo')) : '' }}"
                                id="website_logo">
                        </div>
                        @error('website_logo')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="website_title">Webite title <code>{ key: website_title }</code></label>
                            <input type="text" id="website_title" name="website_title" placeholder="Website Title"
                                class="form-control @error('website_title') is-invalid @enderror"
                                value="{{ setting('website_title') }}">
                        </div>
                        @error('website_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="site_phone_num">Site Phone Number <code>{ key: site_phone_num }</code></label>
                            <input type="number" id="site_phone_num" name="site_phone_num" placeholder="Site Phone Number"
                                class="form-control @error('site_phone_num') is-invalid @enderror"
                                value="{{ setting('site_phone_num') }}">
                        </div>
                        @error('site_phone_num')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="site_email">Site Email <code>{ key: site_email }</code></label>
                            <input type="text" id="site_email" name="site_email" placeholder="Site Email"
                                class="form-control @error('site_email') is-invalid @enderror"
                                value="{{ setting('site_email') }}">
                        </div>
                        @error('site_email')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="site_footer_text">Site Footer Text <code>{ key: site_footer_text }</code></label>
                            <input type="text" id="site_footer_text" name="site_footer_text" placeholder="Site Footer Text"
                                class="form-control @error('site_footer_text') is-invalid @enderror"
                                value="{{ setting('site_footer_text') }}">
                        </div>
                        @error('site_footer_text')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <button type="submit" class="btn btn-primary mb-2">
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush
