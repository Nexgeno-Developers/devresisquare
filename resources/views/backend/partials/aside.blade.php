<aside id="menu" class="sidebar bg-light sidebar">


    <div class="sidebar-header">
        <h4>Admin Menu</h4>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a class="{{ request()->routeIs('backend.dashboard') ? 'active' : '' }}"
                href="{{ route('backend.dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a href="#propertiesSubmenu" data-bs-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.create') ? 'true' : 'false' }}"
                class="dropdown-toggle {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.create') ? 'active' : '' }}">Properties</a>
            <ul class="nav-second-level collapse list-unstyled {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.create') ? 'show' : '' }}"
                id="propertiesSubmenu">
                <li>
                    <a class="{{ request()->routeIs('admin.properties.index') ? 'active' : '' }}"
                        href="{{ route('admin.properties.index') }}">View Properties</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.properties.create') ? 'active' : '' }}"
                        href="{{ route('admin.properties.create') }}">Quick Add Property</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.properties.create') && request()->query('stepform') ? 'active' : '' }}"
                        href="{{ route('admin.properties.create') }}?stepform">Add Property</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="#">Users</a>
        </li>
        <li>
            <a href="#">Settings</a>
        </li>
        <li>
            <a href="#">Reports</a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link">Logout</button>
            </form>
        </li>
    </ul>
</aside>