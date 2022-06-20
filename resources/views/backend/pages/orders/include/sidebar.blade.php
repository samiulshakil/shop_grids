<div class="list-group">
    <a href="{{ route('admin.all.orders') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.all.orders') ? 'active' : '' }}">
        Pending
    </a>
    <a href="{{ route('admin.payment.orders') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.payment.orders') ? 'active' : '' }}">
        Accept Payment
    </a>
    <a href="{{ route('admin.progress.orders') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.progress.orders') ? 'active' : '' }}">
        Progress
    </a>
    <a href="{{ route('admin.delivered.orders') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.delivered.orders') ? 'active' : '' }}">
        Delivered
    </a>
    <a href="{{ route('admin.return.orders') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.return.orders') ? 'active' : '' }}">
        Return Order
    </a>
    <a href="{{ route('admin.return.orders.approved') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.return.orders.approved') ? 'active' : '' }}">
        Return Order Approved
    </a>
    <a href="{{ route('admin.cancel.orders') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.cancel.orders') ? 'active' : '' }}">
        Cancel
    </a>
</div>
