@extends('backend.layouts.master')

@section('title', 'Website Banner Settings')

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
                <div>Website Others Settings</div>
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
            <form action="{{ route('admin.settings.otherbanner.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Banner Two</h5>

                        <div class="form-group">
                            <label for="banner_two_title">Banner Two Title <code>{ key: banner_two_title }</code></label>
                            <input type="text" id="banner_two_title" name="banner_two_title" placeholder="Banner Two Title"
                                class="form-control @error('banner_two_title') is-invalid @enderror"
                                value="{{ setting('banner_two_title') }}">
                        </div>
                        @error('banner_two_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_two_sub_title">Banner Two Sub Title <code>{ key: banner_two_sub_title
                                    }</code></label>
                            <input type="text" id="banner_two_sub_title" name="banner_two_sub_title"
                                placeholder="Banner Two Sub Title"
                                class="form-control @error('banner_two_sub_title') is-invalid @enderror"
                                value="{{ setting('banner_two_sub_title') }}">
                        </div>
                        @error('banner_two_sub_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_two_button_text">Banner Two Button Text <code>{ key: banner_two_button_text
                                    }</code></label>
                            <input type="text" id="banner_two_button_text" name="banner_two_button_text"
                                placeholder="Banner Two Btn Text"
                                class="form-control @error('banner_two_button_text') is-invalid @enderror"
                                value="{{ setting('banner_two_button_text') }}">
                        </div>
                        @error('banner_two_button_text')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_two_image">Banner Two Image <code>{ key:
                                    banner_two_image
                                    }</code></label>
                            <input type="file" data-allowed-file-extensions="jpg jpeg png svg webp gif"
                                class="dropify form-control @error('banner_two_image') is-invalid @enderror"
                                name="banner_two_image"
                                data-default-file="{{ setting('banner_two_image') != null ? Storage::url(setting('banner_two_image')) : '' }}"
                                id="banner_two_image">
                        </div>
                        @error('banner_two_image')
                            <p>
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Banner Three</h5>
                        <div class="form-group">
                            <label for="banner_three_title">Banner Three Title <code>{ key: banner_three_title
                                    }</code></label>
                            <input type="text" id="banner_three_title" name="banner_three_title"
                                placeholder="Banner Three Title"
                                class="form-control @error('banner_three_title') is-invalid @enderror"
                                value="{{ setting('banner_three_title') }}">
                        </div>
                        @error('banner_three_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_three_sub_title">Banner Three Sub Title <code>{ key: banner_three_sub_title
                                    }</code></label>
                            <input type="text" id="banner_three_sub_title" name="banner_three_sub_title"
                                placeholder="Banner Two Sub Title"
                                class="form-control @error('banner_three_sub_title') is-invalid @enderror"
                                value="{{ setting('banner_three_sub_title') }}">
                        </div>
                        @error('banner_three_sub_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_three_button_text">Banner Three Button Text <code>{ key:
                                    banner_three_button_text
                                    }</code></label>
                            <input type="text" id="banner_three_button_text" name="banner_three_button_text"
                                placeholder="Banner Two Btn Text"
                                class="form-control @error('banner_three_button_text') is-invalid @enderror"
                                value="{{ setting('banner_three_button_text') }}">
                        </div>
                        @error('banner_three_button_text')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_three_image">Banner Three Image <code>{ key:
                                    banner_three_image
                                    }</code></label>
                            <input type="file" data-allowed-file-extensions="jpg jpeg png svg webp gif"
                                class="dropify form-control @error('banner_three_image') is-invalid @enderror"
                                name="banner_three_image"
                                data-default-file="{{ setting('banner_three_image') != null ? Storage::url(setting('banner_three_image')) : '' }}"
                                id="banner_three_image">
                        </div>
                        @error('banner_three_image')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Banner Four</h5>
                        <div class="form-group">
                            <label for="banner_four_title">Banner Four Title <code>{ key: banner_four_title
                                    }</code></label>
                            <input type="text" id="banner_four_title" name="banner_four_title"
                                placeholder="Banner Four Title"
                                class="form-control @error('banner_four_title') is-invalid @enderror"
                                value="{{ setting('banner_four_title') }}">
                        </div>
                        @error('banner_four_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_four_sub_title">Banner Four Sub Title <code>{ key: banner_four_sub_title
                                    }</code></label>
                            <input type="text" id="banner_four_sub_title" name="banner_four_sub_title"
                                placeholder="Banner Four Sub Title"
                                class="form-control @error('banner_four_sub_title') is-invalid @enderror"
                                value="{{ setting('banner_four_sub_title') }}">
                        </div>
                        @error('banner_four_sub_title')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_four_price">Banner Three Price <code>{ key:
                                    banner_four_price
                                    }</code></label>
                            <input type="text" id="banner_four_price" name="banner_four_price"
                                placeholder="Banner Button Text"
                                class="form-control @error('banner_four_price') is-invalid @enderror"
                                value="{{ setting('banner_four_price') }}">
                        </div>
                        @error('banner_four_price')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_four_button_text">Banner Four Button Text <code>{ key:
                                    banner_four_button_text
                                    }</code></label>
                            <input type="text" id="banner_four_button_text" name="banner_four_button_text"
                                placeholder="Banner Two Btn Text"
                                class="form-control @error('banner_four_button_text') is-invalid @enderror"
                                value="{{ setting('banner_four_button_text') }}">
                        </div>
                        @error('banner_four_button_text')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="banner_four_image">Banner Four Image <code>{ key:
                                    banner_four_image
                                    }</code></label>
                            <input type="file" data-allowed-file-extensions="jpg jpeg png svg webp gif"
                                class="dropify form-control @error('banner_four_image') is-invalid @enderror"
                                name="banner_four_image"
                                data-default-file="{{ setting('banner_four_image') != null ? Storage::url(setting('banner_four_image')) : '' }}"
                                id="banner_four_image">
                        </div>
                        @error('banner_four_image')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <button type="submit" class="btn btn-primary mb-2 mt-2">
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
