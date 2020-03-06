<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                    <i class="fa fa-dashboard fa-fw"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="waves-effect">
                    <i class="ti-user fa-fw"></i>
                    <span class="hide-menu">Manage Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" class="waves-effect">
                    <i class="ti-cloud fa-fw"></i>
                    <span class="hide-menu">Manage Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sub-categories.index') }}" class="waves-effect">
                    <i class="ti-cloud fa-fw"></i>
                    <span class="hide-menu">Sub Categories</span>
                </a>
            </li>
            <li>
                <a href="index.html" class="waves-effect">
                    <i class="ti-user fa-fw"></i>
                    <span class="hide-menu"> Menu<span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="index.html"><i class=" fa-fw">1</i><span class="hide-menu">Dashboard 1</span></a> </li>
                    <li> <a href="index2.html"><i class=" fa-fw">2</i><span class="hide-menu">Dashboard 2</span></a> </li>
                    <li> <a href="index3.html"><i class=" fa-fw">3</i><span class="hide-menu">Dashboard 3</span></a> </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('messages.index') }}" class="waves-effect">
                    <i class="ti-info fa-fw"></i>
                    <span class="hide-menu">Messages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}" class="waves-effect">
                    <i class="ti-settings fa-fw"></i>
                    <span class="hide-menu">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
