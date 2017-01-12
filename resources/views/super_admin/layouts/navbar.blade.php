<div class="header navbar navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand">
            <img src="{{asset('images/logo.png')}}" alt="logo" class="img-responsive"/>
        </a>
        <!-- END LOGO -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav navbar-left">
            {{--<li>
                <select>
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </li>--}}
            <li class='{{ url()->current() == url('super_admin/dashboard') ? "active" : "" }}'><a href="{{ url('super_admin/dashboard') }}">Dashboard </a></li>
            <li class='{{ url()->current() == url('super_admin/places/all') ? "active" : "" }}'><a href="{{ url('super_admin/places/all') }}">All Restaurants </a></li>
            <li class='{{ url()->current() == url('super_admin/group_admin/new') ? "active" : "" }}'><a href="{{ url('super_admin/group_admin/new') }}">New Admin </a></li>
            {{--<li class='{{ url()->current() == url('super_admin/places/all') ? "active" : "" }}'><a href="{{ url('super_admin/places/all') }}">Logged in </a></li>--}}
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('super_admin/logout') }}">Sign Out</a></li>
        </ul>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>