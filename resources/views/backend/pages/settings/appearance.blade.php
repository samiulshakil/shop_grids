@extends('backend.layouts.master')

@section('title', 'Appearance Settings')

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
            <div>Appearance Settings</div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.dashboard')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Dashboard
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-md-3">
        @include('backend.pages.settings.sidebar')
    </div>
    <div class="col-md-9">
        <form action="{{route('admin.settings.appearance.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title text-center">Basic Info</h5>
                    <div class="form-group">
                        <label for="site_logo">Site Logo (Only image is allowed)</label>
                        <input type="file" 
                        class="dropify form-control @error('site_logo') is-invalid @enderror"
                         name="site_logo" 
                        data-default-file="{{ setting('site_logo') != null ?  Storage::url(setting('site_logo')) : '' }}"
                         id="site_logo">
                    </div>
                    @error('site_logo')
                    <p>
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </p>
                    @enderror

                    <div class="form-group">
                        <label for="site_favicon">Favicon (Only image is allowed. Size 33x33)</label>
                        <input type="file" 
                        class="dropify form-control @error('site_favicon') is-invalid @enderror"
                         name="site_favicon" 
                        data-default-file="{{ setting('site_favicon') != null ?  Storage::url(setting('site_favicon')) : '' }}"
                         id="site_favicon">
                    </div>
                    @error('site_favicon')
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

    