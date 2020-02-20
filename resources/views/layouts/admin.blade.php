<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Dashboard</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- toast CSS -->
    <link href="{{ asset('public/css/jquery.toast.css') }}" rel="stylesheet">
    @yield('header-content')
</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('/home')}}"><b>TAX MANAGEMENT SYSTEM</b></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>

        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if(Auth::user()->role=="Admin")
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">Pending Cheque</span>
                    <span class="badge bg-warning-400">@php echo count($alerts)@endphp</span>
                </a>
                <div class="dropdown-menu dropdown-content width-350">
                    <div class="dropdown-content-heading">
                        Payments
                    </div>
                    <ul class="media-list dropdown-content-body">

                        @if(!empty($alerts)  && count($alerts)>0)
                            @foreach($alerts as $alert)
                                <li class="media">
                                    <div class="media-left">
                                        @if(empty($alert->user->image))
                                        <img src="{{url('public/assets/images/placeholder.jpg')}}" class="img-circle img-sm" alt="">
                                        @else
                                        <img src="{{$alert->user->image}}" class="img-circle img-sm" alt="">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <a href="{{url('payments/'.$alert->id)}}" class="media-heading">
                                            <span class="text-semibold" style="text-transform: capitalize;">{{$alert->user->name  }}</span>
                                            <span class="media-annotation pull-right">{{$alert->date}}</span>
                                        </a>
                                        <span class="text-muted">Please Confirm this payment ...</span>
                                    </div>
                                </li>
                            @endforeach
                            <div class="dropdown-content-footer">
                                <a href="{{url('payments/all')}}" data-popup="tooltip" title="All Pending Check"><i class="icon-menu display-block"></i></a>
                            </div>
                        @else
                            <li class="media">

                                <div class="media-body">
                                    No result found
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>
            </li>
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-git-compare"></i>
                        <span class="visible-xs-inline-block position-right">Complain</span>
                        <span class="badge bg-warning-400">@php echo count($complainss)@endphp</span>
                    </a>
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            New Complain
                        </div>
                        <ul class="media-list dropdown-content-body width-350">
                            @if(!empty($complainss) && count($complainss)>0)
                                @foreach($complainss as $complain)
                            <li class="media">
                                <div class="media-left">
                                    @if(empty($complain->user->image))
                                        <img src="{{url('public/assets/images/placeholder.jpg')}}" class="img-circle img-sm" alt="">
                                    @else
                                        <img src="{{$complain->user->image}}" class="img-circle img-sm" alt="">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <a href="{{url('complains/'.$complain->id)}}" class="media-heading">
                                        <span class="text-semibold" style="text-transform: capitalize;">{{$complain->user->name  }}</span>
                                        <span class="media-annotation pull-right">{{$complain->created_at}}</span>
                                    </a>
                                    <span class="text-muted"> Please Check this complain ...</span>
                                </div>
                            </li>
                           @endforeach
                                    <div class="dropdown-content-footer">
                                        <a href="{{url('complains/all')}}" data-popup="tooltip" title="All Complain Check"><i class="icon-menu display-block"></i></a>
                                    </div>
                            @else
                                <li class="media">

                                    <div class="media-body">
                                        No result found
                                    </div>
                                </li>
                            @endif
                        </ul>

                    </div>
                </li>
            @elseif(Auth::user()->role=="Citizen")
                @php
                    $alerts=alert(Auth::user()->id);
                    $complainss=complains(Auth::user()->id)
                @endphp
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Pending Cheque</span>
                        <span class="badge bg-warning-400">@php echo count($alerts)@endphp</span>
                    </a>
                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            Payments
                        </div>
                        <ul class="media-list dropdown-content-body">

                            @if(!empty($alerts)  && count($alerts)>0)
                                @foreach($alerts as $alert)
                                    <li class="media">
                                        <div class="media-left">
                                            @if(empty($alert->user->image))
                                                <img src="{{url('public/assets/images/placeholder.jpg')}}" class="img-circle img-sm" alt="">
                                            @else
                                                <img src="{{$alert->user->image}}" class="img-circle img-sm" alt="">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="{{url('payments/'.$alert->id)}}" class="media-heading">
                                                <span class="text-semibold" style="text-transform: capitalize;">{{$alert->user->name  }}</span>
                                                <span class="media-annotation pull-right">{{$alert->date}}</span>
                                            </a>
                                            <span class="text-muted">Please Check this payment detail ...</span>
                                        </div>
                                    </li>
                                @endforeach
                                <div class="dropdown-content-footer">
                                    <a href="{{url('payments')}}" data-popup="tooltip" title="All Pending Check"><i class="icon-menu display-block"></i></a>
                                </div>
                            @else
                                <li class="media">

                                    <div class="media-body">
                                        No result found
                                    </div>
                                </li>
                            @endif
                        </ul>

                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-git-compare"></i>
                        <span class="visible-xs-inline-block position-right">Complain</span>
                        <span class="badge bg-warning-400">{{count($complainss)}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            New Complain
                        </div>
                        <ul class="media-list dropdown-content-body width-350">
                            @if(!empty($complainss)  && count($complainss)>0)
                                @foreach($complainss as $complain)
                                    <li class="media">
                                        <div class="media-left">
                                            @if(empty($complain->user->image))
                                                <img src="{{url('public/assets/images/placeholder.jpg')}}" class="img-circle img-sm" alt="">
                                            @else
                                                <img src="{{$complain->user->image}}" class="img-circle img-sm" alt="">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="{{url('complains/'.$complain->id)}}" class="media-heading">
                                                <span class="text-semibold" style="text-transform: capitalize;">{{$complain->user->name  }}</span>
                                                <span class="media-annotation pull-right">{{$complain->created_at}}</span>
                                            </a>
                                            <span class="text-muted"> Please Check this complain ...</span>
                                        </div>
                                    </li>
                                @endforeach
                                    <div class="dropdown-content-footer">
                                        <a href="{{url('complains')}}" data-popup="tooltip" title="All Complain Check"><i class="icon-menu display-block"></i></a>
                                    </div>
                            @else
                                <li class="media">

                                    <div class="media-body">
                                        No result found
                                    </div>
                                </li>
                            @endif
                        </ul>

                    </div>
                </li>
            @endif

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    @if(!empty(Auth::user()->image))
                        <img src="{{Auth::user()->image}}" class="img-circle img-sm" alt="">
                    @else
                    <img src="{{asset('public/assets/images/placeholder.jpg')}}" alt="">
                     @endif
                    <span>{{Auth::user()->name}}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{url('/profile')}}"><i class="icon-user-plus"></i> My profile</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">
                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left">
                                @if(!empty(Auth::user()->image))
                                <img src="{{Auth::user()->image}}" class="img-circle img-sm" alt="">
                                @else
                                <img src="{{asset('public/assets/images/placeholder.jpg')}}" class="img-circle img-sm" alt="">
                                @endif
                            </a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">{{Auth::user()->name}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->
                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <li  @if(Request::segment(1) == 'home') class="active" @endif><a href="{{url('/home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                            <li  @if(Request::segment(1) == 'profile') class="active" @endif><a href="{{url('/profile')}}"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li  @if(Request::segment(1) == 'departments') class="active" @endif>
                                <a href="#"><i class="icon-people"></i> <span>Departments</span></a>
                                <ul>
                                    <li @if(Request::segment(1) == 'departments' && Request::segment(2) == '') class="active" @endif><a href="{{url('departments')}}">Show All Departments</a></li>
                                    @if(Auth::user()->role=='Admin')     <li @if(Request::segment(1) == 'departments' && Request::segment(2) == 'create') class="active" @endif><a href="{{url('departments/create')}}">Add New Department</a></li> @endif
                                </ul>
                            </li>
                            @if(Auth::user()->role=='Admin')
                            <li  @if(Request::segment(1) == 'citizens') class="active" @endif>
                                <a href="#"><i class="icon-people"></i> <span>Citizens</span></a>
                                <ul>
                                    <li @if(Request::segment(1) == 'citizens' && Request::segment(2) == '') class="active" @endif><a href="{{url('citizens')}}">Show All Citizens</a></li>
                                    <li @if(Request::segment(1) == 'citizens' && Request::segment(2) == 'create') class="active" @endif><a href="{{url('citizens/create')}}">Add New Citizen</a></li>
                                </ul>
                            </li>
                            <li  @if(Request::segment(1) == 'properties') class="active" @endif>
                                    <a href="#"><i class="icon-store2"></i> <span>Properties</span></a>
                                    <ul>
                                        <li @if(Request::segment(1) == 'properties' && Request::segment(2) == 'all') class="active" @endif><a href="{{url('properties/all')}}">Show All Properties</a></li>
                                    </ul>
                            </li>
                            <li  @if(Request::segment(1) == 'basic_units') class="active" @endif>
                                <a href="#"><i class="icon-tree5"></i> <span>Basic Unit</span></a>
                                <ul>
                                    <li @if(Request::segment(1) == 'basic_units' && Request::segment(2) == '') class="active" @endif><a href="{{url('basic_units')}}">Show All Basic Units</a></li>
                                    <li @if(Request::segment(1) == 'basic_units' && Request::segment(2) == 'create') class="active" @endif><a href="{{url('basic_units/create')}}">Add New Basic Unit</a></li>
                            </ul>
                            </li>
                            <li  @if(Request::segment(1) == 'tax_report') class="active" @endif><a href="{{url('/tax_report')}}"><i class="glyphicon glyphicon-registration-mark"></i> <span>Taxation Report</span></a></li>
                            <li  @if(Request::segment(1) == 'complains/all') class="active" @endif><a href="{{url('/complains/all')}}"><i class="icon-home4"></i> <span>Complains</span></a></li>
                            <li  @if(Request::segment(1) == 'payments/all') class="active" @endif><a href="{{url('/payments/all')}}"><i class="icon-home4"></i> <span>Payments</span></a></li>


                            @elseif(Auth::user()->role=='Citizen')
                                <li  @if(Request::segment(1) == 'complains') class="active" @endif>
                                    <a href="#"><i class="icon-store2"></i> <span>Complains</span></a>
                                    <ul>
                                        <li @if(Request::segment(1) == 'complains' && Request::segment(2) == '') class="active" @endif><a href="{{url('complains')}}">Show My Complains</a></li>
                                        <li @if(Request::segment(1) == 'complains' && Request::segment(2) == 'create') class="active" @endif><a href="{{url('complains/create')}}">Add New Complain </a></li>
                                    </ul>
                                </li>
                                <li  @if(Request::segment(1) == 'properties') class="active" @endif>
                                    <a href="#"><i class="icon-store2"></i> <span>Property</span></a>
                                    <ul>
                                        <li @if(Request::segment(1) == 'properties' && Request::segment(2) == '') class="active" @endif><a href="{{url('properties')}}">Show My Properties</a></li>
                                        <li @if(Request::segment(1) == 'properties' && Request::segment(2) == 'create') class="active" @endif><a href="{{url('properties/create')}}">Add New Property</a></li>
                                    </ul>
                                </li>
                                <li  @if(Request::segment(1) == 'payments') class="active" @endif>
                                    <a href="#"><i class="icon-credit-card2"></i> <span>Invoice</span></a>
                                    <ul>
                                        <li @if(Request::segment(1) == 'payments' && Request::segment(2) == '') class="active" @endif><a href="{{url('payments')}}">All Payments</a></li>
                                        <li @if(Request::segment(1) == 'payments' && Request::segment(2) == 'create') class="active" @endif><a href="{{url('payments/create')}}">Add Payment</a></li>
                                    </ul>
                                </li>
                                <li  @if(Request::segment(1) == 'tax_calculate') class="active" @endif><a href="{{url('/tax_calculate')}}"><i class="icon-menu3"></i> <span>Tax Calculate</span></a></li>
                            @endif
                            <li  @if(Request::segment(1) == 'tax_scale') class="active" @endif><a href="{{url('/tax_scale')}}"><i class="icon-stack2"></i> <span>Tax Scale</span></a></li>

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->
            </div>
        </div>
        <!-- /main sidebar -->
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><a href="{{ url()->previous() }}"> <i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">{{$page_title}}</span></h4>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
                        @if(!empty($breadcrumbs) && count($breadcrumbs)>0)
                            <li><a href="{{ url($breadcrumbs[0]['url']) }}">{{ $breadcrumbs[0]['title'] }}</a></li>
                        @endif
                        <li class="active">{{ $page_title }}</li>
                    </ul>
                </div>
            </div>
            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <!-- Detached content -->
            @yield('content')
            <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2018. <a href="#">TAX MANAGEMENT SYSTEM</a> by <a href="javascript:" target="_blank">Faisal & Asim</a>
                </div>
                <!-- /footer -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->

<!-- Core JS files -->
<script type="text/javascript" src="{{asset('public/assets/js/plugins/loaders/pace.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/core/libraries/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/plugins/loaders/blockui.min.js')}}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
<!-- /theme JS files -->

<script src="{{ asset('public/js/jquery.toast.js') }}"></script>
<script>
    @if(Session::has('success'))
    $.toast({
        heading: 'Success',
        text: '{{ Session::get('success') }}',
        position: 'bottom-right',
        loaderBg: '#ff6849',
        icon: 'success',
        hideAfter: 3500,
        stack: 6
    });
    @endif
    @if(count($errors) > 0)
    $.toast({
        heading: 'Error',
        text: 'An error has occurred. Please check form fields.',
        position: 'bottom-right',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 3500
    });
    @endif
     $(document).on("click", '#clear', function () {
        $('#selector').val("");
        $('.selector').val("");
    });
</script>
@yield('footer-content')
</body>
</html>
