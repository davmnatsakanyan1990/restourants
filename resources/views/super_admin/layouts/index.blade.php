
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super admin</title>

    <!-- Bootstrap core CSS -->
    <link href="/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- Custom styles for this template -->
    <link href="/super_admin/css/dashboard.css" rel="stylesheet">

    <script>
        var BASE_URL = '{{  url('/') }}'
    </script>

</head>

<body>

@include('super_admin.layouts.navbar')
<div class="container-fluid">


    @include('super_admin.layouts.sidebar')

    <div class="row">
        @yield('content')
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

@yield('scripts')

</body>
</html>
