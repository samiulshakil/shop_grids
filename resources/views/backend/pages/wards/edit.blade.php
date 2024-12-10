@extends('backend.layouts.master')

@section('title', 'ward')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>ward

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.wards.index') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    All wards
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.wards.update', $ward->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Ward Info</h5>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Division</label>
                                    <select onchange="zilaList(this.value)" required
                                        class="js-example-basic-single form-control @error('division_id') is-invalid @enderror"
                                        name="division_id" id="exampleFormControlSelect1">
                                        <option value="">Select Please</option>
                                        @forelse ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                @if ($ward->division_id == $division->id) selected @endif>
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
                                    <select onchange="unionList(this.value)"
                                        class="form-control @error('upazila_id') is-invalid @enderror" name="upazila_id"
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
                                    <label for="union_id">Select Union</label>
                                    <select class="form-control @error('union_id') is-invalid @enderror" name="union_id"
                                        required id="union_id">
                                    </select>
                                </div>
                                @error('union_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="name">Ward Name</label>
                                    <input type="text" id="name" value="{{ $ward->name }}" name="name"
                                        placeholder="Upazila Name"
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
                                            @if ($ward->status == true) checked @endif>
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
    <script>
        $(document).ready(function() {

            let division_id = {{ $ward->division_id }}
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
                    $('#zila_id option[value="' + {{ $ward->zila_id }} + '"]').prop(
                        'selected', true);
                },
                error: function(xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });

            let zila_id = {{ $ward->zila_id }}
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
                    $('#upazila_id option[value="' + {{ $ward->upazila_id }} + '"]').prop(
                        'selected', true);
                },
                error: function(xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });

            let upazila_id = {{ $ward->upazila_id }}
            $.ajax({
                url: "{{ route('admin.union.list') }}",
                type: "POST",
                data: {
                    upazila_id: upazila_id,
                    _token: _token
                },
                dataType: "JSON",
                success: function(data) {
                    $('#union_id').html('');
                    $('#union_id').html(data);
                    $('#union_id option[value="' + {{ $ward->union_id }} + '"]').prop(
                        'selected', true);
                },
                error: function(xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });


        //get zila list
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

        function unionList(upazila_id) {
            if (upazila_id) {
                $.ajax({
                    url: "{{ route('admin.union.list') }}",
                    type: "POST",
                    data: {
                        upazila_id: upazila_id,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#union_id').html('');
                        $('#union_id').html(data);
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                    }
                });
            }
        }
    </script>
@endpush
