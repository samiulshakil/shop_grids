@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                @role('admin')
                Admin Dashboard (Hi Admin)
                @else 
                Dashboard
                @endrole
                <div class="page-title-subheading">This is example dashboard created using build-in elements and components.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button>
            <div class="d-inline-block dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Buttons
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon lnr-inbox"></i>
                                <span>
                                    Inbox
                                </span>
                                <div class="ml-auto badge badge-pill badge-secondary">86</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon lnr-book"></i>
                                <span>
                                    Book
                                </span>
                                <div class="ml-auto badge badge-pill badge-danger">5</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon lnr-picture"></i>
                                <span>
                                    Picture
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a disabled href="javascript:void(0);" class="nav-link disabled">
                                <i class="nav-link-icon lnr-file-empty"></i>
                                <span>
                                    File Disabled
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>    </div>
</div>            
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Users</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$users_count}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Roles</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$roles}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Pages</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$pages}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Menu</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$menus}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-premium-dark">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Products Sold</div>
                    <div class="widget-subheading">Revenue streams</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-warning"><span>$14M</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Joined At: </th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td class="text-center text-muted">{{$key + 1}}</td>
                        <td>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="widget-content-left">
                                            <img width="40" class="rounded-circle" src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar','thumb') : config('app.placeholder').'160' }}" alt="">
                                        </div>
                                    </div>
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading">{{$user->name}}</div>
                                        <div class="widget-subheading opacity-7">{{$user->role->name}}</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center">{{$user->updated_at->diffForHumans()}}</td>
                        @if ($user->status == 1)
                            <td class="text-center">
                                <div class="badge badge-primary">Active</div>
                            </td>
                        @else
                            <td class="text-center">
                                <div class="badge badge-warning">Pending</div>
                            </td>                                          
                        @endif
                        <td class="text-center">
                            <a class="btn btn-success btn-sm" href="{{ route('admin.users.show',$user->id) }}"><i
                                class="fas fa-eye"></i>
                                <span>Show</span>
                            </a>
                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$user->id}})">
                                <i class="fas fa-trash-alt"></i>
                                <span>Delete</span>
                            </button>
                            <form id="delete-form-{{$user->id}}" method="post" action="{{ route('admin.users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
    