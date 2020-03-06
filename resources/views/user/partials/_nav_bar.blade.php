<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="{{ route('user.dashboard') }}">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon-->
                    <img src="@isset($setting['favicon']) {{ asset('uploads/'.$setting['favicon']) }}@endisset" alt="home" class="dark-logo" />
                    <!--This is light logo icon-->
                    <img src="@isset($setting['favicon']) {{ asset('uploads/'.$setting['favicon']) }}@endisset" alt="home" class="light-logo" />
                </b>
                <!-- Logo text image you can use text also -->
                <span class="hidden-xs">
                        <!--This is dark logo text-->
                    <img src="@isset($setting['favicon']) {{ asset('uploads/'.$setting['favicon']) }}@endisset" alt="home" class="dark-logo" /><!--This is light logo text-->
                    <img src="@isset($setting['admin_logo']) {{ asset('uploads/'.$setting['admin_logo']) }}@endisset" alt="home" class="light-logo" />
                     </span> </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" id="notifications" data-toggle="dropdown" href="#">
                    <i class="ti-bell fa-fw"></i>
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown" id="notificationsMenu">
                    <li class="dropdown-header">No notifications</li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">

            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    @if(isset($setting['favicon']))
                    <img src="{{ asset('uploads/'.$setting['favicon']) }}" alt="user-img" width="36" class="img-circle">
                    @else
                        <img src="../plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                    @endif
                    <b class="hidden-xs">{{ Auth::user()->name }}</b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img">
                                @if(isset($setting['favicon']))
                                <img src="{{ asset('uploads/'.$setting['favicon']) }}" alt="user" />
                                @else
                                    <img src="../plugins/images/users/varun.jpg" alt="user" />
                                @endif
                            </div>
                            <div class="u-text">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                                <a href="{{ route('user.profile') }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>