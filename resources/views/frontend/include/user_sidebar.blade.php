<div class="list-group">
    <a href="{{ route('user.dashboard') }}"
        class="list-group-item list-group-item-action {{ Route::is('user.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('user.profile.edit') }}"
        class="list-group-item list-group-item-action {{ Route::is('user.profile.edit') ? 'active' : '' }}">
        Edit Profile
    </a>
    <a href="{{ route('user.password.edit') }}"
        class="list-group-item list-group-item-action {{ Route::is('user.password.edit') ? 'active' : '' }}">
        Change Password
    </a>
    <a href="{{ route('user.order.show') }}"
        class="list-group-item list-group-item-action {{ Route::is('user.order.show') ? 'active' : '' }}">
        Orders
    </a>
    <a href="{{ route('user.return.order') }}"
        class="list-group-item list-group-item-action {{ Route::is('user.return.order') ? 'active' : '' }}">
        Order Return
    </a>
    <a href="{{ route('wish.show') }}"
        class="list-group-item list-group-item-action {{ Route::is('wish.show') ? 'active' : '' }}">
        Wishlists
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
            onclick="event.preventDefault();
                                        this.closest('form').submit();"
            tabindex="0" class="dropdown-item">Log Out</a>
    </form>
</div>
