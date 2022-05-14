@extends('backend.layouts.master')

@section('title', 'Sub Categories')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Sub Categories

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.subcategories.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Sub Categories
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.subcategories.update', $sub_category->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sub Category Info</h5>
                            <div class="form-group">
                                <label for="category_id">Category select</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                 @foreach ($categories as $category)
                                  <option value="{{$category->id}}" 
                                    {{$sub_category->category_id == $category->id ? 'selected' : ''}}
                                    >
                                    {{$category->category_name}}</option>
                                @endforeach
                                </select>
                              </div>
                            @error('category_id')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror
                            <div class="form-group">
                              <label for="sub_category_name">Sub Category Name</label>
                              <input type="text" value="{{$sub_category->sub_category_name}}" id="sub_category_name" name="sub_category_name" placeholder="Sub Category Name" class="form-control 
                              @error('sub_category_name') is-invalid @enderror" required>
                            </div>
                          @error('sub_category_name')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox"
                                {{$sub_category->sub_category_status == 1 ? 'checked' : ''}}
                                name="sub_category_status" class="custom-control-input" id="sub_category_status">
                                <label class="custom-control-label" for="sub_category_status">Status</label>
                            </div>
                        </div>
                        @error('sub_category_status')
                        <p>
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </p>
                        @enderror
                          <button type="submit" class="btn btn-primary mb-2">
                                <i class="fas fa-plus-circle"></i>
                                <span>Update</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
