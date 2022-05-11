@extends('backend.layouts.master')

@section('title', 'Edit Password')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-lock icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Password Edit</div>
        </div>  
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.password.update')}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Edit Password</h5>
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="current_password" placeholder="Current Password" class="form-control 
                                @error('current_password') is-invalid @enderror" required>
                            </div>
                            @error('current_password')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="password" placeholder="New Password" class="form-control 
                                @error('password') is-invalid @enderror" required>
                            </div>
                            @error('password')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
                        
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" 
                                class="form-control @error('password') is-invalid @enderror required">
                            </div>
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

    