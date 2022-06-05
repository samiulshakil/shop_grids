<div class="list-group">
    <a href="{{ route('admin.settings.website') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.settings.website') ? 'active' : '' }}">Website
        Settings
    </a>
    <a href="{{ route('admin.settings.socialmedias.index') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.settings.socialmedias.index') ? 'active' : '' }}">
        Social Media
    </a>
    <a href="{{ route('admin.settings.banners.index') }}"
        class="list-group-item list-group-item-action {{ Route::is('admin.settings.banners.index') ? 'active' : '' }}">
        Banner
    </a>
</div>
