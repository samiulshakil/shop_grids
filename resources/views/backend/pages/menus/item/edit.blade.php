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
        <form action="{{route('admin.menus.item.update', ['id' => $menu->id, 'itemId' => $menuItem->id])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Manage Menu Items</h5>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="custom-select" id="type" name="type" onchange="setItemType()">
                                    <option value="item" @if ($menuItem->type == 'item')
                                        selected
                                    @endif>Menu Item</option>
                                    <option value="divider" @if ($menuItem->type == 'divider')
                                        selected
                                    @endif>Divider</option>
                                </select>
                            </div>

                            <div id="divider_fields">
                                <div class="form-group">
                                    <label for="divider_title">Title of the Divider</label>
                                    <input type="text" class="form-control @error('divider_title') is-invalid @enderror" id="divider_title"
                                           name="divider_title"
                                           placeholder="Divider Title"
                                           value="{{$menuItem->divider_title}}">
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
                                    <input type="text" value="{{$menuItem->title}}" class="form-control @error('title') is-invalid @enderror" id="title"
                                           name="title"
                                           placeholder="Title"
                                           autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="url">URL for the Menu Item</label>
                                <input type="text" value="{{$menuItem->url}}" class="form-control @error('url') is-invalid @enderror" id="url"
                                       name="url" value="{{$menuItem->url}}"
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
                                        value="_self" @if ($menuItem->target == '_self')
                                        selected @endif> Same Tab/Window
                                    </option>
                                    <option value="_blank" @if ($menuItem->target == '_blank')
                                            selected @endif> New Tab/Window
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
                                       value="{{$menuItem->icon_class}}">
                                @error('icon_class')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
    $('input[name="type"]').change(setItemType);
</script>
@endpush

    