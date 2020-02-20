@extends('layouts.admin')

@section('content')
    <div class="container-detached">
        <div class="content-detached">
            <!-- 2 columns form -->
            <form method="POST"
                  action="{{ url('departments'.(empty($department) ? '': '/' . $department->id)) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Department Information</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                           
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{old('name', @$department->name)}}"   placeholder="Username" class="form-control">
                                                @if ($errors->has('name'))
                                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('tax') ? ' has-error' : '' }}">
                                                <label>Tax <span class="text-danger">*</span></label>
                                                <input type="number" name="tax" value="{{old('tax', @$department->tax)}}"  placeholder="Tax" class="form-control">
                                                @if ($errors->has('tax'))
                                                    <span class="help-block"><strong>{{ $errors->first('tax') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="text-right">
                            @if(!empty($department)) {!! method_field('PUT') !!} @endif
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                @if(empty($department)) Save @else Update
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

    <script type="text/javascript" src="{{asset('public/assets/js/plugins/visualization/echarts/echarts.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/user_profile_tabbed.js')}}"></script>
    <!-- /theme JS files -->


@endsection
