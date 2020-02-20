@extends('layouts.admin')

@section('content')
    <div class="container-detached">
        <div class="content-detached">
            <!-- 2 columns form -->
            <form method="POST"
                  action="{{ url('complains'.(empty($complain) ? '': '/' . $complain->id)) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Complain Information</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('complain') ? ' has-error' : '' }}">
                                    <label>Complain</label>
                                    <textarea cols="10" rows="10" name="complain" class="wysihtml5 wysihtml5-min form-control" placeholder="Enter Complain ...">
                                                        {{old('complain', @$complain->complain)}}
									               </textarea>
                                    @if ($errors->has('complain'))
                                        <span class="help-block"><strong>{{ $errors->first('complain') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                            
                        <div class="text-right">
                            @if(!empty($complain)) {!! method_field('PUT') !!} @endif
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                @if(empty($complain)) Save @else Update
                                @endif  <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                  
                </div>
                </div>
            </form>
            <!-- /2 columns form -->
        </div>
    </div>
    <!-- /detached content -->
@endsection

@section('footer-content')

   

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/fullcalendar/fullcalendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/visualization/echarts/echarts.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/editors/wysihtml5/wysihtml5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/editors/wysihtml5/toolbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/editors/wysihtml5/parsers.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/notifications/jgrowl.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/editor_wysihtml5.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/user_profile_tabbed.js')}}"></script>

@endsection
