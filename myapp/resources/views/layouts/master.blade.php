<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link href="{{ asset('css/inspinia/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css.inspinia/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inspinia/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inspinia/style.css') }}" rel="stylesheet">

</head>
<body>
	<div id="wrapper">
        @include('partials/_left_sidebar')   

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        @include('partials/_top_navbar')
        </div>
            @yield('content')
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2015
                </div>
            </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/inspinia/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/inspinia/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/inspinia/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/inspinia/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia/inspinia.js') }}"></script>
    <script src="{{ asset('js/inspinia/plugins/pace/pace.min.js') }}"></script>
    @yield('resources')
</body>
</html>
