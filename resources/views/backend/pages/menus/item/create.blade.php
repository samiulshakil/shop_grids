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
            <a href="{{route('admin.menus.builder', $menu->id)}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Menu Builder
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <form action="{{route('admin.menus.item.store', $menu->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Manage Menu Items</h5>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="custom-select" id="type" name="type" onchange="setItemType()">
                                    <option value="item">Menu Item</option>
                                    <option value="divider">Divider</option>
                                </select>
                            </div>

                            <div id="divider_fields">
                                <div class="form-group">
                                    <label for="divider_title">Title of the Divider</label>
                                    <input type="text" class="form-control @error('divider_title') is-invalid @enderror" id="divider_title"
                                           name="divider_title"
                                           placeholder="Divider Title"
                                           autofocus>
                                    @error('divider_title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="item_fields">
                                <div class="form-group">
                                    <label for="title">Title of the Menu Item</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                           name="title"
                                           placeholder="Title">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="url">URL for the Menu Item</label>
                                <input type="text" class="form-control" id="url"
                                       name="url"
                                       placeholder="URL">
                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="target">Open In</label>
                                <select name="target" id="target"
                                        class="form-control @error('target') is-invalid @enderror">
                                    <option
                                        value="_self">
                                        Same Tab/Window
                                    </option>
                                    <option
                                        value="_blank">
                                        New Tab/Window
                                    </option>
                                </select>
                                @error('target')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="icon_class">Font Icon class for the Menu Item <a target="_blank"
                                        href="https://fontawesome.com/">(Use
                                        a Fontawesome Font Class)</a> </label>
                                <input type="text" class="form-control @error('icon_class') is-invalid @enderror"
                                       id="icon_class" name="icon_class"
                                       placeholder="Icon Class (optional)"
                                       >
                                @error('icon_class')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
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
<script type="text/javascript">
    function setItemType(){
        if($('select[name="type"]').val() == 'divider'){
            $('#divider_fields').removeClass('d-none');
            $('#item_fields').addClass('d-none');
        }else{
            $('#divider_fields').addClass('d-none');
            $('#item_fields').removeClass('d-none');
        }
    }; 
    setItemType();
</script>
@endpush

    