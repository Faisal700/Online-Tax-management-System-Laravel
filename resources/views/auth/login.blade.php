@extends('layouts.app')

@section('content')
    <!-- Content area -->
    <div class="content pb-20">

        <!-- Tabbed form -->
        <div class="tabbable panel login-form width-400">
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#basic-tab1" data-toggle="tab"><h6>Sign in</h6></a></li>
              
            </ul>

            <div class="tab-content panel-body">
                <div class="tab-pane fade in active" id="basic-tab1">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocuss>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback has-feedback-left{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group login-options">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember
                                    </label>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                            <a href="{{url('/register')}}" class="btn bg-blue btn-block">Sign Up<i class="icon-arrow-right14 position-right"></i></a>
                        </div>
                    </form>
                    <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
                </div>
                <div class="tab-pane fade" id="basic-tab2">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="text-center">
                            <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                            <h5 class="content-group">Create new account <small class="display-block">All fields are required</small></h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback has-feedback-left{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Your email" value="{{ old('email') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-mention text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback has-feedback-left{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" placeholder="Create password" name="password" required>
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>
                        <div class="content-divider text-muted form-group"><span>Additions</span></div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="styled" checked="checked">
                                    Send me <a href="#">test account settings</a>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="styled" checked="checked">
                                    Subscribe to monthly newsletter
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="styled">
                                    Accept <a href="#">terms of service</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-indigo-400 btn-block">Register <i class="icon-circle-right2 position-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /tabbed form -->
    </div>
    <!-- /content area -->
@endsection
