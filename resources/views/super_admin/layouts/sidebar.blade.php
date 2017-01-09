<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class='{{ url()->current() == url('super_admin/dashboard') ? "active" : "" }}'><a href="{{ url('super_admin/dashboard') }}">Dashboard </a></li>
        <li class='{{ url()->current() == url('super_admin/places/all') ? "active" : "" }}'><a href="{{ url('super_admin/places/all') }}">All Restaurants </a></li>
        <li class='{{ url()->current() == url('super_admin/group_admin/new') ? "active" : "" }}'><a href="{{ url('super_admin/group_admin/new') }}">New Admin </a></li>
    </ul>
</div>