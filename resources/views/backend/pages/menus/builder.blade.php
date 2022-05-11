@extends('backend.layouts.master')

@section('title', 'Menus')

@push('css')
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css"> 
<style>
    .menu-builder .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: inherit;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }
    .menu-builder .dd .item_actions {
        z-index: 9;
        position: relative;
        top: 10px;
        right: 10px;
    }
    .menu-builder .dd .item_actions .edit {
        margin-right: 5px;
    }
    .menu-builder .dd-handle {
        display: block;
        height: 50px;
        margin: 5px 0;
        padding: 14px 25px;
        color: #333;
        text-decoration: none;
        font-weight: 700;
        border: 1px solid #ccc;
        background: #fafafa;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
</style>
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Menu Builder ({{$menu->name}})</div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('admin.menus.index')}}" class="mr-3 btn btn-success">
                <i class="fas fa-plus-circle"></i>
                All Menus
            </a>
            <a href="{{route('admin.menus.item.create', $menu->id)}}" class="mr-3 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Create Menu Item
            </a>
        </div>    
    </div>
</div>            

<div class="row">
    <div class="col-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p>You can output a menu anywhere on your site by calling <code>menu('name')</code></p>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body menu-builder">
                <h5 class="card-title"></h5>
                <div class="dd">
                    <ol class="dd-list">
                        @forelse ($menu->menuitems as $item)
                        <li class="dd-item" data-id="{{$item->id}}">
                            <div class="pull-right item_actions">
                                <a href="{{route('admin.menus.item.edit', ['id' => $menu->id, 'itemId' => $item->id])}}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$item->id}})">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Delete</span>
                                </button>
                                <form id="delete-form-{{$item->id}}" method="post" 
                                    action="{{ route('admin.menus.item.destroy', ['id' => $menu->id, 'itemId' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                            <div class="dd-handle">
                                @if ($item->type == 'divider')
                                    <strong>Divider: {{$item->divider_title}}</strong>
                                @else
                                <span>{{$item->title}}</span> 
                                <small class="url">{{$item->url}}</small>
                                @endif
                            </div>
                            @if (!$item->childs->isEmpty())
                            <ol class="dd-list">
                                @foreach ($item->childs as $child)
                                <li class="dd-item" data-id="{{$child->id}}">
                                    <div class="pull-right item_actions">
                                        <a href="{{route('admin.menus.item.edit', ['id' => $menu->id, 'itemId' => $child->id])}}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$child->id}})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{$child->id}}" method="post" 
                                            action="{{ route('admin.menus.item.destroy', ['id' => $menu->id, 'itemId' => $child->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                    <div class="dd-handle">
                                        @if ($child->type == 'divider')
                                            <strong>Divider: {{$child->divider_title}}</strong>
                                        @else
                                        <span>{{$child->title}}</span> 
                                        <small class="url">{{$child->url}}</small>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ol>
                            @endif
                        </li>
                        @empty
                            <div class="text-center">
                                <strong>No Menu Items Found.</strong>
                            </div>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/iziToast.js') }}"></script>
@include('vendor.lara-izitoast.toast')
<script src="http://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script> 
<script>
        $(function () {
            $('.dd').nestable({maxDepth: 2});
            $('.dd').on('change', function (e) {
                $.post('{{ route('admin.menus.order',$menu->id) }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Successfully updated menu order.',
                    });
                });
            });
        })
</script>
@endpush

    