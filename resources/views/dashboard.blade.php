@extends('layouts.admin')

@section('header-content')
    <!-- Bootstrap 3.3.7 -->
    {{--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">--}}
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">--}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('public/adminlte/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    <![endif]-->

@endsection
@section('content')
    <!-- Main content -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$properties}}</h3>

                    <p>Properties</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                @if(Auth::user()->role=="Citizen")
                <a href="{{url('properties')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @else
                    <a href="{{url('properties/all')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$departments}}</h3>

                    <p>Departments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('/departments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$citizens}}</h3>

                    <p>Citizens Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('/users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$complains}}</h3>

                    <p>Complains</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                @if(Auth::user()->role=="Citizen")
                    <a href="{{url('/complains')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @else
                    <a href="{{url('/complains/all')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- /.content -->

@endsection

@section('footer-content')
    <!-- jQuery 3 -->
    {{--<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>--}}
    <!-- jQuery UI 1.11.4 -->
    {{--<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>--}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    {{--<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>--}}
    <!-- Morris.js charts -->
    <script src="{{asset('public/adminlte/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('public/adminlte/bower_components/morris.js/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('public/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('public/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('public/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('public/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('public/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('public/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('public/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('public/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('public/adminlte/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('public/adminlte/dist/js/demo.js')}}"></script>


@endsection
