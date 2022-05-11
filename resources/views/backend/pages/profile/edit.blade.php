@extends('backend.layouts.master')

@section('title', 'Edit Profile')

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
                <i class="pe-7s-edit icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Profile Edit</div>
        </div>  
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                        <div class="form-group">
                            <label for="avatar">Select Avatar</label>
                            <input type="file" class="dropify form-control" name="avatar" 
                            id="avatar" data-default-file="{{Auth::user()->getFirstMediaUrl('avatar')}}">
                        </div>
                        @error('avatar')
                        <p>
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </p>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Edit User</h5>
                            <div class="form-group">
                              <label for="name">User Name</label>
                              <input type="text" id="name" name="name" value="{{Auth::user()->name}}" placeholder="Name" class="form-control 
                              @error('name') is-invalid @enderror" required>
                            </div>
                          @error('name')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror
                          <div class="form-group">
                              <label for="email">User Email</label>
                              <input type="email" id="email" name="email" value="{{Auth::user()->email}}" placeholder="Email" class="form-control 
                              @error('email') is-invalid @enderror" required>
                          </div>
                          @error('email')
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
    