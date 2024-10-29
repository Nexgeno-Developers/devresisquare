<aside id="menu" class="bg-light sidebar">
    <div class="sidebar-header">
        <h4>Admin Menu</h4>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a class="active" href="{{ route('backend.dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a href="#propertiesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Properties</a>
            <ul class="collapse list-unstyled" id="propertiesSubmenu">
                <li>
                    <a href="{{ route('admin.properties.index') }}">View Properties</a>
                </li>
                <li>
                    <a href="{{ route('admin.properties.create') }}">Add Property</a>
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