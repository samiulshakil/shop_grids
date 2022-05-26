@extends('backend.layouts.master')

@section('title', 'Coupon')

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
                <i class="pe-7s-arc icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Coupon

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.coupons.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Coupons
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.coupons.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Coupon Info</h5>
                            <div class="form-group">
                              <label for="code">Coupon Code</label>
                              <input type="text" id="code" name="code" placeholder="Code" class="form-control 
                              @error('code') is-invalid @enderror"
                              value="{{ old('code') }}" required>
                            </div>
                          @error('code')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror

                        <div class="form-group">
                            <label for="type">Coupon Type select</label>
                            <select value="{{ old('type') }}"
                            class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                <option value="percent">Percent</option>
                                <option value="regular">Regular</option>
                            </select>
                        </div>
                        @error('type')
                        <p>
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </p>
                        @enderror

                        <div class="form-group">
                            <label for="value">Coupon Value</label>
                            <input type="text" id="value" value="{{ old('value') }}"
                            name="value" placeholder="Value" class="form-control 
                            @error('code') is-invalid @enderror" required>
                          </div>
                        @error('value')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="expire">Coupon Expire Date</label>
                            <input type="date" value="2022-07-20"
                            min="2022-02-20" max="2032-02-20" name="expire" 
                            placeholder="expire" class="form-control 
                            @error('code') is-invalid @enderror" required>
                          </div>
                        @error('expire')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" class="custom-control-input" id="status">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>

@endpush
    