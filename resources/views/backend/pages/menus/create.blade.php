@extends('backend.layouts.master')

@section('title', 'Menus')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Menu

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.menus.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Menus
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.menus.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Menu Info</h5>
                            <div class="form-group">
                              <label for="name">Menu Name</label>
                              <input type="text" id="name" name="name" placeholder="Name" class="form-control 
                              @error('name') is-invalid @enderror" required autofocus>
                            </div>
                          @error('name')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror
                          <div class="form-group">
                              <label for="description">Description</label>
                              <textarea type="text" id="description" name="description" class="form-control 
                                    @error('description') is-invalid @enderror" autofocus>
                              </textarea>
                          </div>
                          @error('description')
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

    