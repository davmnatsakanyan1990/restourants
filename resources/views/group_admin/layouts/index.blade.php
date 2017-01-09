<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/group_admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/group_admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/group_admin/fonts/fonts.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="/group_admin/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="icon" type="image/png" href="/group_admin/img/favicon.ico" sizes="32x32">
<script>
    var BASE_URL = '{{ url('/') }}'
</script>
    @yield('styles')
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-fixed">
<!-- BEGIN HEADER -->
@include('group_admin.layouts.header')
<!-- END HEADER -->
<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    {{--@include('admin.layouts.sidebar')--}}
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    @yield('content')
    <!-- END CONTENT -->

    <!-- BEGIN FOOTER -->
    @include('group_admin.layouts.footer')
    <!-- END FOOTER -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/admin/plugins/respond.min.js"></script>
<script src="/admin/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/group_admin/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/admin/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="/group_admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/admin/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
<script src="/admin/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/admin/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/admin/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/admin/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

@yield('scripts')

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

