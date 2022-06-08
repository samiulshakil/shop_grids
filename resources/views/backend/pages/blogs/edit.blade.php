@extends('backend.layouts.master')

@section('title', 'Blogs Edit')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .label-info {
            background-color: #5076f4;

        }

        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out,
                border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Blogs Edit

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.blogs.index') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    All Blogs
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Basic Info</h5>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" placeholder="title"
                                        value="{{ $blog->title }}"
                                        class="form-control
                                        @error('title') is-invalid @enderror"
                                        required>
                                </div>
                                @error('title')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="sub_title">Sub Title</label>
                                    <input type="text" id="sub_title" name="sub_title" value="{{ $blog->sub_title }}"
                                        placeholder="Sub Title"
                                        class="form-control 
                                        @error('sub_title') is-invalid @enderror"
                                        required>
                                </div>
                                @error('sub_title')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="description">Blog Description</label>
                                    <textarea type="text" id="description" name="description"
                                        class="form-control 
                                @error('description') is-invalid @enderror" required>
                                {{ $blog->description }}
                            </textarea>
                                </div>
                                @error('description')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="minute_read">Minute</label>
                                    <input type="number" id="minute_read" name="minute_read" placeholder="Minute"
                                        value="{{ $blog->minute_read }}"
                                        class="form-control 
                                        @error('minute_read') is-invalid @enderror"
                                        required>
                                </div>
                                @error('minute_read')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Image and Status</h5>
                                <div class="form-group">
                                    <label for="image">Select Image</label>
                                    <input type="file" data-default-file="{{ asset($blog->image) }}"
                                        class="dropify form-control" name="image" id="image" required>
                                </div>
                                @error('image')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status"
                                            @if ($blog->status == true) checked @endif class="custom-control-input"
                                            id="status">
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


                                <div class="form-group">
                                    <label for="category_id">Category select</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                            <option {{ $blog->category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="card-title">Tags Info</div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" id="tags" data-role="tagsinput" name="tags" placeholder="Tags"
                                        value="{{ $blog->tags }}"
                                        class="form-control 
                                @error('tags') is-invalid @enderror">
                                </div>
                                @error('tags')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <div class="form-group">
                                    <label for="hash_tags">Hash Tags</label>
                                    <input type="text" id="hash_tags" data-role="tagsinput" name="hash_tags"
                                        value="{{ $blog->hash_tags }}" placeholder="Hash Tags"
                                        class="form-control 
                                @error('hash_tags') is-invalid @enderror">
                                </div>
                                @error('hash_tags')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/8emazpsdtafe9zqrpmeotzedm36or24c00hxiynn1c724vi2/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            tinymce.init({
                selector: '#description',
                plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                imagetools_cors_hosts: ['picsum.photos'],
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                image_advtab: true,
                content_css: '//www.tiny.cloud/css/codepen.min.css',
                importcss_append: true,
                height: 400,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: "mceNonEditable",
                toolbar_mode: 'sliding',
                contextmenu: "link image imagetools table",
            });

        });
    </script>
@endpush
