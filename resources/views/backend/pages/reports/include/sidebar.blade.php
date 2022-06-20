<div class="list-group">
    <a href="{{ route('admin.reports') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.reports') ? 'active' : '' }}">
        Today Order
    </a>
    <a href="{{ route('admin.today.delivered') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.today.delivered') ? 'active' : '' }}">
        Today Delivered
    </a>
    <a href="{{ route('admin.this.month') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.this.month') ? 'active' : '' }}">
        This Month
    </a>
    <a href="{{ route('admin.search.reports') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.search.reports') ? 'active' : '' }}">
        Search Reports
    </a>
</div>
