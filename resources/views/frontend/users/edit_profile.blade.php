@extends('frontend.layouts.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
    </style>
@endpush

@section('mainContent')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Edit Password</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('website.home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>Edit Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard" style="padding-top:90px; padding-bottom:90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.include.user_sidebar')
                </div>
                <div class="col-lg-9">
                    <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="avatar">Select Avatar</label>
                                            <input type="file" class="dropify form-control" name="avatar" id="avatar"
                                                data-default-file="{{ Auth::user()->getFirstMediaUrl('avatar') }}">
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
                                        <div class="form-group mt-2">
                                            <label for="name">User Name</label>
                                            <input type="text" id="name" name="name"
                                                value="{{ Auth::user()->name }}" placeholder="Name"
                                                class="form-control 
                              @error('name') is-invalid @enderror"
                                                required>
                                        </div>
                                        @error('name')
                                            <p>
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </p>
                                        @enderror
                                        <div class="form-group mt-2">
                                            <label for="email">User Email</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ Auth::user()->email }}" placeholder="Email"
                                                class="form-control 
                              @error('email') is-invalid @enderror"
                                                required>
                                        </div>
                                        @error('email')
                                            <p>
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </p>
                                        @enderror
                                        <button type="submit" class="btn btn-primary mt-3">
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
