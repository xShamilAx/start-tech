<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{url('admin')}}" class="nav-link">
                <i class="nav-icon fas fa-chart-area"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

{{--        @can('MANAGE_PRODUCT')--}}
            <li class="nav-item">
                <a href="{{url('/admin/product')}}" class="nav-link">
                    <i class="nav-icon fas fa-box-open"></i>
                    <p>
                        Product
                    </p>
                </a>
            </li>
{{--        @endcan--}}


        @can('MANAGE_SETTINGS')
            <li class="nav-item has-treeview {{ Request::is('admin/configurations*') ? 'menu-open' : '' }} {{ Request::is('admin/config_categories*') ? 'menu-open' : '' }} {{ Request::is('admin/settings*') ? 'menu-open' : '' }} {{ Request::is('admin/users*') ? 'menu-open' : '' }} {{ Request::is('admin/roles*') ? 'menu-open' : '' }} {{ Request::is('admin/permissions*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Setting
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('MANAGE_CONFIGS')
                        <li class="nav-item">
                            <a href="{{url('/admin/configurations')}}"
                               class="nav-link {{ Request::is('admin/configurations') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Configurations</p>
                            </a>
                        </li>
                    @endcan
                    @can('MANAGE_CONFIG_CATEGORIES')
                        <li class="nav-item">
                            <a href="{{url('/admin/config_categories')}}"
                               class="nav-link {{ Request::is('admin/config_categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Config Categories</p>
                            </a>
                        </li>
                    @endcan

                    @can('MANAGE_USERS')
                        <li class="nav-item">
                            <a href="{{url('/admin/users')}}"
                               class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    @endcan
                    @can('MANAGE_ROLES')
                        <li class="nav-item">
                            <a href="{{url('/admin/roles')}}"
                               class="nav-link {{ Request::is('admin/roles') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    @endcan
                    @can('MANAGE_PERMISSIONS')
                        <li class="nav-item">
                            <a href="{{url('/admin/permissions')}}"
                               class="nav-link {{ Request::is('admin/permissions') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>
</nav>
<!-- /.sidebar-menu -->
