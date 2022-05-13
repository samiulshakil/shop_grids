@extends('backend.layouts.master')

@section('title', 'Categories')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Categories

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.categories.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Categories
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Category Info</h5>
                            <div class="form-group">
                              <label for="category_name">Category Name</label>
                              <input type="text" id="category_name" name="category_name" placeholder="Category Name" class="form-control 
                              @error('category_name') is-invalid @enderror" autofocus required>
                            </div>
                          @error('category_name')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror
                          <div class="form-group">
                            <label for="category_image">Select Image</label>
                            <input type="file" id="avatar" data-show-errors="true" data-errors-position="outside"
                            data-allowed-file-extensions="jpg jpeg png svg webp gif" class="dropify form-control @error('category_image') is-invalid @enderror" name="category_image" id="category_image">
                        </div>
                        @error('category_image')
                        <p>
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </p>
                        @enderror
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="category_status" class="custom-control-input" id="category_status">
                                <label class="custom-control-label" for="category_status">Status</label>
                            </div>
                        </div>
                        @error('category_status')
                        <p>
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </p>
                        @enderror
                          <button type="submit" class="btn btn-primary mb-2">
                                <i class="fas fa-plus-circle"></i>
                                <span>Create</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        $('.js-example-basic-single').select2();
    });
</script>

@endpush
    