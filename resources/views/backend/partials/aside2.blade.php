<aside id="menu" class="sidebar bg-light sidebar">
    <ul class="list-unstyled components">
        <li class="sidebar-list-item">
            <a class="{{ request()->routeIs('backend.dashboard') ? 'active' : '' }}"
                href="{{ route('backend.dashboard') }}">
                <i class="fa-solid fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="sidebar-list-item submenu_wrapper">
            <a href="#propertiesSubmenu" data-bs-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.soft_deleted') || request()->routeIs('admin.properties.create') ? 'true' : 'false' }} "
                class="dropdown-toggle {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.quick') || request()->routeIs('admin.properties.soft_deleted') || request()->routeIs('admin.properties.create') ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i> Properties
            </a>
            <ul class="nav-second-level collapse list-unstyled {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.quick') || request()->routeIs('admin.properties.soft_deleted') || request()->routeIs('admin.properties.create') ? 'show' : '' }}"
                id="propertiesSubmenu">
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.index') ? 'active' : '' }}"
                        href="{{ route('admin.properties.index') }}">
                        <i class="fa-solid fa-eye"></i> View Properties
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.quick') ? 'active' : '' }}"
                        href="{{ route('admin.properties.quick') }}">
                        <i class="fa-solid fa-plus"></i> Add Property
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.properties.soft_deleted') ? 'active' : '' }}"
                        href="{{ route('admin.properties.soft_deleted') }}">
                        <i class="fa-solid fa-trash"></i> Deleted Properties
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-list-item submenu_wrapper">
            <a href="#contactsSubmenu" data-bs-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.contacts.index') || request()->routeIs('contacts.create') ? 'true' : 'false' }}"
                class="dropdown-toggle {{ request()->routeIs('admin.contacts.index') || request()->routeIs('contacts.create') ? 'active' : '' }}">
                <i class="fa-solid fa-address-book"></i> Contacts
            </a>
            <ul class="nav-second-level collapse list-unstyled {{ request()->routeIs('admin.contacts.index') || request()->routeIs('contacts.create') ? 'show' : '' }}"
                id="contactsSubmenu">
                <li class="sidebar-sub-list-item">
                    <a href="{{ route('admin.contacts.index') }}"
                        class="{{ request()->routeIs('admin.contacts.index') && !request()->has('category') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> All
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a href="{{ route('admin.contacts.index', ['category' => 1]) }}"
                        class="{{ request()->category == 1 ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> Owners
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a href="{{ route('admin.contacts.index', ['category' => 2]) }}"
                        class="{{ request()->category == 2 ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> Property Managers
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a href="{{ route('admin.contacts.index', ['category' => 3]) }}"
                        class="{{ request()->category == 3 ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> Tenants
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a href="{{ route('admin.contacts.index', ['category' => 4]) }}"
                        class="{{ request()->category == 4 ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i> Landlords
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-list-item">
            <a href="#">
                <i class="fa-solid fa-home"></i> Tenancies
            </a>
        </li>

        <li class="sidebar-list-item submenu_wrapper">
            <a href="#repairSubmenu" data-bs-toggle="collapse" aria-expanded="
                {{
                    request()->routeIs('admin.property_repairs.index') ||
                    request()->routeIs('admin.property_repairs.create') ? 'true' : 'false'
                }} "
                class="dropdown-toggle {{ request()->routeIs('admin.property_repairs.index') || request()->routeIs('admin.property_repairs.create') ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i> Repair
            </a>
            <ul class="nav-second-level collapse list-unstyled {{ request()->routeIs('admin.property_repairs.index') || request()->routeIs('admin.property_repairs.create') ? 'show' : '' }}"
                id="repairSubmenu">
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.property_repairs.index') ? 'active' : '' }}"
                        href="{{ route('admin.property_repairs.index') }}">
                        <i class="fa-solid fa-eye"></i> View Repair issues
                    </a>
                </li>
                <li class="sidebar-sub-list-item">
                    <a class="{{ request()->routeIs('admin.property_repairs.create') ? 'active' : '' }}"
                        href="{{ route('admin.property_repairs.create') }}">
                        <i class="fa-solid fa-trash"></i> Raise Repair Issue
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-list-item">
            <a href="#">
                <i class="fa-solid fa-file-alt"></i> Documents
            </a>
        </li>
        <hr>

        <li class="sidebar-list-item submenu_wrapper">
            <a href="#masterManageSubmenu" data-bs-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.branches.index') || request()->routeIs('admin.designations.index') || request()->routeIs('admin.tenancy_types.index') || request()->routeIs('admin.tenancy_types.create') || request()->routeIs('admin.tenancy_sub_statuses.index') || request()->routeIs('admin.tenancy_sub_statuses.create') ? 'true' : 'false' }}"
                class="dropdown-toggle {{ request()->routeIs('admin.branches.index') || request()->routeIs('admin.designations.index') || request()->routeIs('admin.tenancy_types.index') || request()->routeIs('admin.tenancy_types.create') || request()->routeIs('admin.tenancy_sub_statuses.index') || request()->routeIs('admin.tenancy_sub_statuses.create') ? 'active' : '' }}">
                <i class="fa-solid fa-cogs"></i> Master Manage
            </a>
            <ul class="nav-second-level collapse list-unstyled {{ request()->routeIs('contact-categories.index') || request()->routeIs('admin.branches.index') || request()->routeIs('admin.designations.index') || request()->routeIs('admin.tenancy_types.index') || request()->routeIs('admin.tenancy_types.create') || request()->routeIs('admin.tenancy_sub_statuses.index') || request()->routeIs('admin.tenancy_sub_statuses.create') ? 'show' : '' }}"
                id="masterManageSubmenu">

                <li class="sidebar-list-item">
                    <a class="{{ request()->routeIs('contact-categories.index') ? 'active' : '' }}"
                        href="{{ route('contact-categories.index') }}">
                        <i class="fa-solid fa-tags"></i> Categories
                    </a>
                </li>

                <li class="sidebar-list-item">
                    <a class="{{ request()->routeIs('admin.branches.index') ? 'active' : '' }}"
                        href="{{ route('admin.branches.index') }}">
                        <i class="fa-solid fa-sitemap"></i> Branches
                    </a>
                </li>

                <li class="sidebar-list-item">
                    <a class="{{ request()->routeIs('admin.designations.index') ? 'active' : '' }}"
                        href="{{ route('admin.designations.index') }}">
                        <i class="fa-solid fa-user-tag"></i> Designation
                    </a>
                </li>

                <!-- Tenancy Types Section -->
                <li class="sidebar-sub-list-item submenu_wrapper">
                    <a href="#tenancyTypesSubmenu" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('admin.tenancy_types.index') || request()->routeIs('admin.tenancy_types.create') ? 'true' : 'false' }}"
                        class="dropdown-toggle {{ request()->routeIs('admin.tenancy_types.index') || request()->routeIs('admin.tenancy_types.create') ? 'active' : '' }}">
                        <i class="fa-solid fa-clipboard-list"></i> Tenancy Types
                    </a>
                    <ul class="nav-third-level collapse list-unstyled {{ request()->routeIs('admin.tenancy_types.index') || request()->routeIs('admin.tenancy_types.create') ? 'show' : '' }}"
                        id="tenancyTypesSubmenu">
                        <li class="sidebar-sub-sub-list-item">
                            <a class="{{ request()->routeIs('admin.tenancy_types.index') ? 'active' : '' }}"
                                href="{{ route('admin.tenancy_types.index') }}">
                                <i class="fa-solid fa-eye"></i> View All
                            </a>
                        </li>
                        <li class="sidebar-sub-sub-list-item">
                            <a class="{{ request()->routeIs('admin.tenancy_types.create') ? 'active' : '' }}"
                                href="{{ route('admin.tenancy_types.create') }}">
                                <i class="fa-solid fa-plus"></i> Add
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Tenancy Sub Status Section -->
                <li class="sidebar-sub-list-item submenu_wrapper">
                    <a href="#tenancySubStatusSubmenu" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('admin.tenancy_sub_statuses.index') || request()->routeIs('admin.tenancy_sub_statuses.create') ? 'true' : 'false' }}"
                        class="dropdown-toggle {{ request()->routeIs('admin.tenancy_sub_statuses.index') || request()->routeIs('admin.tenancy_sub_statuses.create') ? 'active' : '' }}">
                        <i class="fa-solid fa-stream"></i> Tenancy Sub Status
                    </a>
                    <ul class="nav-third-level collapse list-unstyled {{ request()->routeIs('admin.tenancy_sub_statuses.index') || request()->routeIs('admin.tenancy_sub_statuses.create') ? 'show' : '' }}"
                        id="tenancySubStatusSubmenu">
                        <li class="sidebar-sub-sub-list-item">
                            <a class="{{ request()->routeIs('admin.tenancy_sub_statuses.index') ? 'active' : '' }}"
                                href="{{ route('admin.tenancy_sub_statuses.index') }}">
                                <i class="fa-solid fa-eye"></i> View All
                            </a>
                        </li>
                        <li class="sidebar-sub-sub-list-item">
                            <a class="{{ request()->routeIs('admin.tenancy_sub_statuses.create') ? 'active' : '' }}"
                                href="{{ route('admin.tenancy_sub_statuses.create') }}">
                                <i class="fa-solid fa-plus"></i> Add
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="sidebar-list-item">
            <a href="#">
                <i class="fa-solid fa-users"></i> Users
            </a>
        </li>
        <li class="sidebar-list-item">
            <a href="#">
                <i class="fa-solid fa-cogs"></i> Settings
            </a>
        </li>
        <li class="sidebar-list-item">
            <a href="#">
                <i class="fa-solid fa-chart-bar"></i> Reports
            </a>
        </li>
        <li class="sidebar-list-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link logout_btn">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</aside>
<div class="backdrop"></div>
