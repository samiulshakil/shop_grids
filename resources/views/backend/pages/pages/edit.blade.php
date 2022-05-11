@extends('backend.layouts.master')

@section('title', 'Pages')

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
                <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Pages

            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.pages.index')}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                All Pages
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.pages.update', $page->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Basic Info</h5>
                            <div class="form-group">
                              <label for="name">Page Name</label>
                              <input type="text" id="name" name="name" value="{{$page->name}}" placeholder="Name" class="form-control 
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
                              <label for="short_description">Short Description</label>
                              <textarea type="short_description" id="short_description" name="short_description" class="form-control 
                                    @error('short_description') is-invalid @enderror" autofocus>
                                    {{$page->short_description}}
                              </textarea>
                          </div>
                          @error('short_description')
                              <p>
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              </p>
                          @enderror

                          <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="body" id="body" name="body" class="form-control 
                                @error('body') is-invalid @enderror" required autofocus>
                                {{$page->body}}
                            </textarea>
                        </div>
                        @error('body')
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
                            <input type="file" data-default-file="{{$page->getFirstMediaUrl('image')}}" class="dropify form-control" name="image" id="image">
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
                                <input type="checkbox" name="status" class="custom-control-input" 
                                id="status" @if ($page->status == 1)
                                    checked
                                @endif>
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

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="card-title">Meta Info</div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <input type="meta_description" value="{{$page->meta_description}}" id="meta_description" name="meta_description" placeholder="Meta Description" class="form-control 
                                @error('meta_description') is-invalid @enderror">
                            </div>
                            @error('meta_description')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong> 
                                    </span>
                                </p>
                            @enderror
        
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="meta_keyword" value="{{$page->meta_keyword}}" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword" class="form-control 
                                @error('meta_keywords') is-invalid @enderror">
                            </div>
                            @error('meta_keyword')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
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
<script src="https://cdn.tiny.cloud/1/8emazpsdtafe9zqrpmeotzedm36or24c00hxiynn1c724vi2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        
        tinymce.init({
            selector: '#body',
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
    