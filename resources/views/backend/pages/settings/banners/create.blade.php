@extends('backend.layouts.master')

@section('title', 'Create Banner')

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
                <div>Create Banner</div>
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
                    <h5 class="card-title">Banner Create</h5>
                    </p>
                </div>
            </div>
            <form action="{{ route('admin.settings.banners.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Basic Info</h5>

                        <div class="form-group">
                            <label for="banner_image">Select Banner Size Should be (800*500)</label>
                            <input type="file" id="banner_image" data-show-errors="true" data-errors-position="outside"
                                data-allowed-file-extensions="jpg jpeg png svg webp gif"
                                class="dropify form-control @error('banner_image') is-invalid @enderror" name="banner_image"
                                id="banner_image">
                        </div>
                        @error('banner_image')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_title">Banner Title</label>
                            <input type="text" id="banner_title" name="banner_title" placeholder="Title"
                                class="form-control @error('banner_title') is-invalid @enderror"
                                value="{{ old('banner_title') }}" required>
                        </div>
                        @error('banner_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_sub_title">Banner Sub Title</label>
                            <input type="text" id="banner_sub_title" name="banner_sub_title" placeholder="Sub Title"
                                class="form-control @error('banner_sub_title') is-invalid @enderror"
                                value="{{ old('banner_sub_title') }}" required>
                        </div>
                        @error('banner_sub_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_description">Description</label>
                            <input type="text" id="banner_description" name="banner_description" placeholder="Description"
                                class="form-control @error('banner_description') is-invalid @enderror"
                                value="{{ old('banner_description') }}" required>
                        </div>
                        @error('banner_description')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_price">Price</label>
                            <input type="number" id="banner_price" name="banner_price" placeholder="Price"
                                class="form-control @error('banner_price') is-invalid @enderror"
                                value="{{ old('banner_price') }}" required>
                        </div>
                        @error('banner_price')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_button_text">Button Text</label>
                            <input type="text" id="banner_button_text" name="banner_button_text" placeholder="Button Text"
                                class="form-control @error('banner_button_text') is-invalid @enderror"
                                value="{{ old('banner_button_text') }}" required>
                        </div>
                        @error('banner_button_text')
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

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.dropify2').dropify();
        });
    </script>
@endpush
