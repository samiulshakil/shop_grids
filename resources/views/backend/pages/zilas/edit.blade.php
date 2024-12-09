@extends('backend.layouts.master')

@section('title', 'zila')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Zila

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.zilas.index') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    All Zilas
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.zilas.update', $zila->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Zila Info</h5>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Division</label>
                                    <select
                                        class="js-example-basic-single form-control @error('division_id') is-invalid @enderror"
                                        name="division_id" id="exampleFormControlSelect1">
                                        @forelse ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                @if ($zila->division_id == $division->id) selected @endif>
                                                {{ $division->name }}</option>
                                        @empty
                                            <p>No division found.</p>
                                        @endforelse
                                    </select>
                                </div>
                                @error('division_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="name">Zila Name</label>
                                    <input type="text" id="name" value="{{ $zila->name }}" name="name"
                                        placeholder="Zila Name"
                                        class="form-control 
                              @error('name') is-invalid @enderror"
                                        autofocus>
                                </div>
                                @error('name')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status"
                                            @if ($zila->status == true) checked @endif>
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
