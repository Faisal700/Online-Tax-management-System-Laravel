@extends('layouts.admin')

@section('content')
            <div class="container-detached">
                <div class="content-detached">
                    <!-- 2 columns form -->
                    <form method="POST"
                          action="{{ url('profile/'.Auth::user()->id) }}"
                          enctype="multipart/form-data">
                        {!! method_field('PUT') !!}
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
                                            @if(!empty(Auth::user()->image))
                                                <img src="{{Auth::user()->image}}" style="height:150px!important;text-align: center " alt="">
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
                                                    <input type="text" name="name" value="{{old('name', @Auth::user()->name)}}"   placeholder="Username" class="form-control">
                                                    @if ($errors->has('name'))
                                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input type="text" name="email" value="{{old('email', @Auth::user()->email)}}"  placeholder="Email" class="form-control">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input type="text" name="phone" value="{{old('phone', @Auth::user()->phone)}}"  placeholder="Phone" class="form-control">
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                        <label>Address </label>
                                                        <input type="text" name="address" value="{{old('address', @$user->address)}}"  placeholder="Address" class="form-control">
                                                        @if ($errors->has('address'))
                                                            <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role=="Citizen")
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="select" name="type">
                                                            <option value="Business Man" {{ old('type', @$user->type) == 'Business Man' ? 'selected="selected"':'' }}>
                                                                Business Man
                                                            </option>
                                                            <option value="Job Holder" {{ old('type', @$user->type) == 'Job Holder' ? 'selected="selected"':'' }}>
                                                                Job Holder
                                                            </option>
                                                            <option value="Labour" {{ old('type', @$user->type) == 'Labour' ? 'selected="selected"':'' }}>
                                                                Labour
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('annual_income') ? ' has-error' : '' }}">
                                                        <label>Annual Income </label>
                                                        <input type="text" name="annual_income" value="{{old('annual_income', @$user->annual_income)}}"  placeholder="Annual Income" class="form-control">
                                                        @if ($errors->has('annual_income'))
                                                            <span class="help-block"><strong>{{ $errors->first('annual_income') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                           </div>
                                         @endif
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="text-right">

                                    <button type="submit" class="btn btn-primary">
                                        Update
                                          <i class="icon-arrow-right14 position-right"></i></button>
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
