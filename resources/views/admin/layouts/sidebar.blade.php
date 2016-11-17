<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone">
                </div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="#" method="POST">
                    <div class="form-container">
                        <div class="input-box">
                            <a href="javascript:;" class="remove">
                            </a>
                            <input type="text" placeholder="Search..."/>
                            <input type="button" class="submit" value=" "/>
                        </div>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start ">
                <a href="{{ url('admin/dashboard') }}">
                    <i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/payment/subscribe') }}">
                    <i class="fa fa-money" aria-hidden="true"></i>
						<span class="title">
							Subscribe
						</span>
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="javascript:;">--}}
                    {{--<i class="fa fa-gift"></i>--}}
						{{--<span class="title">--}}
							{{--Frontend Themes--}}
						{{--</span>--}}
						{{--<span class="arrow">--}}
						{{--</span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete E-Commerce Frontend Theme For Metronic Admin">--}}
                        {{--<a href="http://keenthemes.com/preview/index.php?theme=metronic_ecommerce" target="_blank">--}}
								{{--<span class="title">--}}
									{{--E-Commerce Frontend--}}
								{{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">--}}
                        {{--<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">--}}
								{{--<span class="title">--}}
									{{--Corporate Frontend--}}
								{{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="active ">--}}
                {{--<a href="javascript:;">--}}
                    {{--<i class="fa fa-cogs"></i>--}}
						{{--<span class="title">--}}
							{{--Page Layouts--}}
						{{--</span>--}}
						{{--<span class="selected">--}}
						{{--</span>--}}
						{{--<span class="arrow open">--}}
						{{--</span>--}}
                {{--</a>--}}
                {{--<ul class="sub-menu">--}}
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--Dashboard & Mega Menu--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--Horizontal & Sidebar Menu--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>