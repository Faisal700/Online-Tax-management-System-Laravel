@extends('layouts.admin')

@section('content')
    <div class="container-detached">
        <div class="content-detached">
            <!-- 2 columns form -->
            <form method="POST"
                  action="{{ url('citizens'.(empty($citizen) ? '': '/' . $citizen->id)) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Profile Information</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6" >
                                    @if(!empty($citizen->image))
                                        <img src="{{$citizen->image}}" style="height:150px!important;" alt="">
                                    @endif
                                <div class="form-group">
                                    <label>Attach Photo:</label>
                                    <input type="file" name="image" class="file-styled">
                                    @if ($errors->has('image'))
                                        <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend class="text-semibold"><i class="icon-reading position-left"></i> Acounts details</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{old('name', @$citizen->name)}}"   placeholder="Username" class="form-control">
                                                @if ($errors->has('name'))
                                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="text" name="email" value="{{old('email', @$citizen->email)}}"  placeholder="Email" class="form-control">
                                                @if ($errors->has('email'))
                                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password"   placeholder="Password" class="form-control">
                                                @if ($errors->has('password'))
                                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label>Phone </label>
                                                <input type="text" name="phone" value="{{old('phone', @$citizen->phone)}}"  placeholder="Phone" class="form-control">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label>Address </label>
                                                <input type="text" name="address" value="{{old('address', @$citizen->address)}}"  placeholder="Address" class="form-control">
                                                @if ($errors->has('address'))
                                                    <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="select" name="type">
                                                    <option value="Business Man" {{ old('type', @$citizen->type) == 'Business Man' ? 'selected="selected"':'' }}>
                                                        Business Man
                                                    </option>
                                                    <option value="Job Holder" {{ old('type', @$citizen->type) == 'Job Holder' ? 'selected="selected"':'' }}>
                                                        Job Holder
                                                    </option>
                                                    <option value="Labour" {{ old('type', @$citizen->type) == 'Labour' ? 'selected="selected"':'' }}>
                                                        Labour
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('annual_income') ? ' has-error' : '' }}">
                                                <label>Annual Income </label>
                                                <input type="text" name="annual_income" value="{{old('annual_income', @$citizen->annual_income)}}"  placeholder="Annual Income" class="form-control">
                                                @if ($errors->has('annual_income'))
                                                    <span class="help-block"><strong>{{ $errors->first('annual_income') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="text-right">
                            @if(!empty($citizen)) {!! method_field('PUT') !!} @endif
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                @if(empty($citizen)) Save @else Update
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
