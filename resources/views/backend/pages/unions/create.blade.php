@extends('backend.layouts.master')

@section('title', 'Union')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Unions

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.unions.index') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    All Union
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.unions.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Union Info</h5>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Division</label>
                                    <select onchange="zilaList(this.value)" required
                                        class="js-example-basic-single form-control @error('division_id') is-invalid @enderror"
                                        name="division_id" id="exampleFormControlSelect1">
                                        <option value="">Select Please</option>
                                        @forelse ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
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
                                    <label for="zila_id">Select Zila</label>
                                    <select onchange="upazilaList(this.value)"
                                        class="form-control @error('zila_id') is-invalid @enderror" name="zila_id" required
                                        id="zila_id">
                                    </select>
                                </div>
                                @error('zila_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="upazila_id">Select Upazila</label>
                                    <select class="form-control @error('upazila_id') is-invalid @enderror" name="upazila_id"
                                        required id="upazila_id">
                                    </select>
                                </div>
                                @error('upazila_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror


                                <div class="form-group">
                                    <label for="name">Union Name</label>
                                    <input type="text" id="name" name="name" placeholder="Union Name"
                                        class="form-control 
                              @error('name') is-invalid @enderror"
                                        autofocus required>
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
    <script>
        function zilaList(division_id) {
            if (division_id) {
                $.ajax({
                    url: "{{ route('admin.zila.list') }}",
                    type: "POST",
                    data: {
                        division_id: division_id,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#zila_id').html('');
                        $('#zila_id').html(data);
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                    }
                });
            }
        }

        function upazilaList(zila_id) {
            if (zila_id) {
                $.ajax({
                    url: "{{ route('admin.upazila.list') }}",
                    type: "POST",
                    data: {
                        zila_id: zila_id,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#upazila_id').html('');
                        $('#upazila_id').html(data);
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                    }
                });
            }
        }
    </script>
@endpush
