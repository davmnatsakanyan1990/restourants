<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">RestAdviser</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class='{{ url()->current() == url('super_admin/dashboard') ? "active" : "" }}'><a href="{{ url('super_admin/dashboard') }}">Dashboard </a></li>
                <li class='{{ url()->current() == url('super_admin/places/all') ? "active" : "" }}'><a href="{{ url('super_admin/places/all') }}">All Restaurants </a></li>
                <li class='{{ url()->current() == url('super_admin/group_admin/new') ? "active" : "" }}'><a href="{{ url('super_admin/group_admin/new') }}">New Admin </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('super_admin/logout') }}">Sign Out</a></li>
            </ul>
        </div>
    </div>
</nav>