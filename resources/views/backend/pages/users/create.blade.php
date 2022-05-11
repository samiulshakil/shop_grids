@extends('backend.layouts.master')

@section('title', 'Create Users')

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
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Users

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.users.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Users
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Create User</h5>
                            <div class="form-group">
                              <label for="name">User Name</label>
                              <input type="text" id="name" name="name" placeholder="Name" class="form-control 
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
                              <input type="email" id="email" name="email" placeholder="Email" class="form-control 
                              @error('email') is-invalid @enderror" required>
                          </div>
                          @error('email')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror
                          <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" id="password" name="password" placeholder="Password" class="form-control 
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="card-title">Select Role</label>
                                <select class="js-example-basic-single form-control @error('role_id') is-invalid @enderror" name="role_id" id="exampleFormControlSelect1">
                                @forelse ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @empty
                                        <p>No roles found.</p>
                                    @endforelse
                                </select>
                            </div>
                            @error('role_id')
                            <p>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror

                        <div class="form-group">
                            <label for="avatar">Select Avatar</label>
                            <input type="file" class="dropify form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar" required>
                        </div>
                        @error('avatar')
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        $('.js-example-basic-single').select2();
    });
</script>

@endpush
    