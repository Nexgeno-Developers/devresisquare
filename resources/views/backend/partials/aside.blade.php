<aside id="menu" class="sidebar bg-light sidebar">


    <div class="sidebar-header">
        <h4>Admin Menu</h4>
    </div>
    <ul class="list-unstyled components">
        <li class="sidebar-list-item">
            <a class="{{ request()->routeIs('backend.dashboard') ? 'active' : '' }}"
                href="{{ route('backend.dashboard') }}">Dashboard</a>
        </li>
        <li class="sidebar-list-item submenu_wrapper">
            <a href="#propertiesSubmenu" data-bs-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.create') ? 'true' : 'false' }}"
                class="dropdown-toggle {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.create') ? 'active' : '' }}">Properties</a>
            <ul class="nav-second-level collapse list-unstyled {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.create') ? 'show' : '' }}"
                id="propertiesSubmenu">
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.index') ? 'active' : '' }}"
                        href="{{ route('admin.properties.index') }}">View Properties</a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.create') ? 'active' : '' }}"
                        href="{{ route('admin.properties.create') }}">Quick Add Property</a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.create') && request()->query('stepform') ? 'active' : '' }}"
                        href="{{ route('admin.properties.create') }}?stepform">Add Property</a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.soft_deleted') ? 'active' : '' }}"
                        href="{{ route('admin.properties.soft_deleted') }}">Soft Deleted Properties</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-list-item">
            <a href="#">Users</a>
        </li>
        <li class="sidebar-list-item">
            <a href="#">Settings</a>
        </li>
        <li class="sidebar-list-item">
            <a href="#">Reports</a>
        </li>
        <li class="sidebar-list-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link">Logout</button>
            </form>
        </li>
    </ul>
</aside>