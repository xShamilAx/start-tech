<nav class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
    <a href="{{url('')}}" class="">
        <span class="brand-text font-weight-light">Admim</span>
    </a>
    </li>

</ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

@if(Auth::user()!= null)

                <li  class="nav-item d-none d-sm-inline-block "><a href="#"><strong
                                id="header_user_welcome_msg" class="nav-link">WELCOME <i>{{strtoupper(Auth::user()->first_name)}}</i></strong></a>
                </li>

                    <li  class="nav-item d-none d-sm-inline-block "><a href="{{url('/admin/my_profile')}}"><strong
                                id="header_user_welcome_msg" class="nav-link">View Profile</strong></a>
                    </li>
                @endif
                <li class="nav-item d-none d-sm-inline-block"><a href="{{url('admin/change_password')}}"
                                                                 class="nav-link {{ Request::is('admin/configurations') ? 'active' : '' }}">Change Password</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block"><a class="nav-link" href="{{route('logout')}}"
                                                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </li>
                <!-- /.messages-menu -->


            </ul>
        </div>

    </ul>
</nav>
