<div class="app-header header-shadow">
    <div class="app-header__logo">
        {{-- <div class="logo-src"></div> --}}
        <div class="navbar-brand">
            {{setting('site_title')}}
        </div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>
            <ul class="header-menu nav">
                <li class="dropdown nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon fa fa-cog"></i>
                        View Site
                    </a>
                </li>
            </ul>        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="40" height="40" class="rounded-circle" src="{{Auth::user()->getFirstMediaUrl('avatar')}}" alt="">
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('admin.profile.edit')}}" tabindex="0" class="dropdown-item">Profile</a>
                                    <a href="{{route('admin.password.edit')}}" tabindex="0" class="dropdown-item">Change Password</a>
                                    <a href="" tabindex="0" class="dropdown-item">Settings</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                                        this.closest('form').submit();" tabindex="0" class="dropdown-item">Log Out</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info d-block">
                            <div class="widget-heading">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="widget-subheading">
                                {{ Auth::user()->role->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>  