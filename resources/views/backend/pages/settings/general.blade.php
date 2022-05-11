@extends('backend.layouts.master')

@section('title', 'General Setting')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>General Settings</div>
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
        {{-- how to use callout --}}
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">How To Use:</h5>
                <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code></p>
            </div>
        </div>
        <form action="{{route('admin.settings.general.update')}}" method="post">
            @csrf
            @method('put')
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title text-center">Basic Info</h5>
                    <div class="form-group">
                      <label for="site_title">Site Title <code>{ key: site_title }</code></label>
                      <input type="text" id="site_title" name="site_title" placeholder="Site Title" 
                        class="form-control @error('site_title') is-invalid @enderror"
                        value="{{setting('site_title')}}" required>
                    </div>
                    @error('site_title')
                        <p>
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </p>
                    @enderror

                    <div class="form-group">
                        <label for="site_description">Site Description <code>{ key: site_description }</code></label>
                        <input type="text" id="site_description" name="site_description" placeholder="Site Description" 
                          class="form-control @error('site_description') is-invalid @enderror"
                          value="{{setting('site_description')}}">
                      </div>
                      @error('site_description')
                          <p>
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          </p>
                      @enderror

                      <div class="form-group">
                        <label for="site_address">Site Description <code>{ key: site_address }</code></label>
                        <input type="text" id="site_address" name="site_address" placeholder="Site Address" 
                          class="form-control @error('site_address') is-invalid @enderror"
                          value="{{setting('site_address')}}">
                      </div>
                      @error('site_address')
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

    