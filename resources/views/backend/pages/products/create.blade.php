@extends('backend.layouts.master')

@section('title', 'Products')

@push('css')
    <!-- summernote link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
        .require_star {
            color:red;
        }

        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #5076f4;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-graph2 icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Products

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.products.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Products
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Product Info</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="brand_id">Brand select</label>
                                        <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id" id="brand_id">
                                            <option value="">Select Please</option>
                                            @foreach ($brands as $brand)
                                          <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                    @error('brand_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="category_id">Category select<span class="require_star"> *</span></label>
                                        <select onchange="subCategoryList(this.value)" class="form-control @error('category_id') is-invalid @enderror"
                                         name="category_id" id="category_id">
                                            <option value="">Select Please</option>
                                            @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->category_name}}</option>
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="subcategory_id">Sub Category select</label>
                                        <select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id">
                                        </select>
                                      </div>
                                    @error('subcategory_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_name">Product Name<span class="require_star"> *</span></label>
                                        <input type="text" id="product_name" value="{{ old('product_name') }}" name="product_name" placeholder="Product Name" class="form-control 
                                        @error('product_name') is-invalid @enderror">
                                      </div>
                                    @error('product_name')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_code">Product Code <span class="require_star"> *</span></label>
                                        <input type="text" value="{{ Str::random(5) }}" id="product_code" name="product_code" placeholder="Product Code" class="form-control 
                                        @error('product_code') is-invalid @enderror">
                                      </div>
                                    @error('product_code')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_qty">Product Quantity<span class="require_star"> *</span></label>
                                        <input type="number" value="{{ old('product_qty') }}" id="product_qty" name="product_qty" placeholder="Product Quantity" class="form-control 
                                        @error('product_qty') is-invalid @enderror">
                                      </div>
                                    @error('product_qty')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_tags">Product Tags<span class="require_star"> *</span></label>
                                        <input type="text" value="{{ old('product_tags') }}" data-role="tagsinput" id="product_tags" name="product_tags" placeholder="Product Tags" class="form-control 
                                        @error('product_tags') is-invalid @enderror">
                                      </div>
                                    @error('product_tags')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_size">Product Size</label>
                                        <input type="text" value="{{ old('product_size') }}" data-role="tagsinput" id="product_size" name="product_size" placeholder="Product Size" class="form-control 
                                        @error('product_size') is-invalid @enderror">
                                      </div>
                                    @error('product_size')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_color">Product Color<span class="require_star"> *</span></label>
                                        <input type="text" value="{{ old('product_color') }}" data-role="tagsinput" id="product_color" name="product_color" placeholder="Product Color" class="form-control 
                                        @error('product_color') is-invalid @enderror">
                                      </div>
                                    @error('product_color')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="selling_price">Selling Price<span class="require_star"> *</span></label>
                                        <input type="number" value="{{ old('selling_price') }}" id="selling_price" name="selling_price" placeholder="Selling Price" class="form-control 
                                        @error('selling_price') is-invalid @enderror">
                                      </div>
                                    @error('selling_price')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="discount_price">Discount Price<span class="require_star"> *</span></label>
                                        <input value="{{ old('discount_price') }}" type="number" id="discount_price" name="discount_price" placeholder="Discount Price" class="form-control 
                                        @error('discount_price') is-invalid @enderror">
                                      </div>
                                    @error('discount_price')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_thumbnail">Select Thumbnail<span class="require_star"> *</span></label>
                                        <input type="file" id="product_thumbnail" data-show-errors="true" data-errors-position="outside"
                                        data-allowed-file-extensions="jpg jpeg png svg webp gif" class="dropify form-control
                                         @error('product_thumbnail') is-invalid @enderror" name="product_thumbnail" id="product_thumbnail">
                                    </div>
                                    @error('product_thumbnail')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image_one">Select Image One<span class="require_star"> *</span></label>
                                        <input type="file" id="image_one" data-show-errors="true" data-errors-position="outside"
                                        data-allowed-file-extensions="jpg jpeg png svg webp gif" class="form-control dropi
                                         @error('image_one') is-invalid @enderror" name="image_one">
                                    </div>
                                    @error('image_one')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image_two">Select Image Two<span class="require_star"> *</span></label>
                                        <input type="file" id="image_two" data-show-errors="true" data-errors-position="outside"
                                        data-allowed-file-extensions="jpg jpeg png svg webp gif" class="dropify form-control
                                         @error('image_two') is-invalid @enderror" name="image_two">
                                    </div>
                                    @error('image_two')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image_three">Select Image Three<span class="require_star"> *</span></label>
                                        <input type="file" id="image_three" data-show-errors="true" data-errors-position="outside"
                                        data-allowed-file-extensions="jpg jpeg png svg webp gif" class="form-control dropi
                                         @error('image_three') is-invalid @enderror" name="image_three">
                                    </div>
                                    @error('image_three')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="short_description">Short Description<span class="require_star"> *</span></label>
                                        <textarea type="text" id="summernote" name="short_description" placeholder="Short Description" class="form-control 
                                        @error('short_description') is-invalid @enderror"></textarea>
                                      </div>
                                    @error('short_description')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="long_description">Long Description<span class="require_star"> *</span></label>
                                        <textarea type="text" id="summernote2" name="long_description" placeholder="Long Description" class="form-control 
                                        @error('long_description') is-invalid @enderror"></textarea>
                                      </div>
                                    @error('long_description')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="key_features">Key Features<span class="require_star"> *</span></label>
                                        <textarea type="text" id="summernote3" name="key_features" placeholder="Key Features" class="form-control 
                                        @error('key_features') is-invalid @enderror"></textarea>
                                      </div>
                                    @error('key_features')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="specifications">Specifications<span class="require_star"> *</span></label>
                                        <textarea type="text" id="summernote4" name="specifications" placeholder="Specifications" class="form-control 
                                        @error('specifications') is-invalid @enderror"></textarea>
                                      </div>
                                    @error('specifications')
                                        <p>
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" name="hot_deals" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Hot Deals</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" name="featured" class="form-check-input" id="exampleCheck2">
                                        <label class="form-check-label" for="exampleCheck2">Featured</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" name="special_offer" class="form-check-input" id="exampleCheck3">
                                        <label class="form-check-label" for="exampleCheck3">Special Offer</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" name="special_deals" class="form-check-input" id="exampleCheck4">
                                        <label class="form-check-label" for="exampleCheck4">Special Deals</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="product_status" class="custom-control-input mt-2" id="product_status">
                                    <label class="custom-control-label" for="product_status">Status</label>
                                </div>
                            </div>
                            @error('product_status')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                            @enderror
                            <button type="submit" class="btn btn-primary p-2">
                                <i class="fas fa-plus-circle"></i>
                                <span>Create Product</span>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{asset('js/bootstrap-tagsinput.min.js')}}" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();

        $('#image_one').dropify();
        $('#image_two').dropify();
        $('#image_three').dropify();

      });

      $(function(){
          'use strict';
          // Summernote editor
          $('#summernote').summernote({
            height: 150,
            placeholder: 'Short Description',
            tooltip: false
          })
          $('#summernote2').summernote({
            height: 150,
            placeholder: 'Long Description',
            tooltip: false
          })
          $('#summernote3').summernote({
            height: 150,
            placeholder: 'Features',
            tooltip: false
          })
          $('#summernote4').summernote({
            height: 150,
            placeholder: 'Specefications',
            tooltip: false
          })
        });

    //get sub category by dependenci select box
    function subCategoryList(category_id) {
        if (category_id) {
            $.ajax({
                url: "{{route('admin.subcategory.list')}}",
                type: "POST",
                data: {
                    category_id: category_id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $('#subcategory_id').html('');
                    $('#subcategory_id').html(data);
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        }
    }

</script>

@endpush
    