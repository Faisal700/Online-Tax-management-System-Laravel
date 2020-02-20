<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('public/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('public/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/pages/login.js') }}"></script>
    <!-- /theme JS files -->
</head>
<body class="login-container login-cover">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

    {{--<div id="app">--}}
        {{--<nav class="navbar navbar-default navbar-static-top">--}}
            {{--<div class="container">--}}
                {{--<div class="navbar-header">--}}

                    {{--<!-- Collapsed Hamburger -->--}}
                    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">--}}
                        {{--<span class="sr-only">Toggle Navigation</span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                    {{--</button>--}}

                    {{--<!-- Branding Image -->--}}
                    {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                        {{--{{ config('app.name', 'Laravel') }}--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="nav navbar-nav">--}}
                        {{--&nbsp;--}}
                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@guest--}}
                            {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                            {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                        {{--@else--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<ul class="dropdown-menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('logout') }}"--}}
                                            {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                            {{--Logout--}}
                                        {{--</a>--}}

                                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                            {{--{{ csrf_field() }}--}}
                                        {{--</form>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--@endguest--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        {{--@yield('content')--}}
    {{--</div>--}}
            @yield('content')
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('public/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('public/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/pages/login.js') }}"></script>
    <!-- /theme JS files -->
</body>
</html>
