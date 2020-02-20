@extends('layouts.admin')

@section('header-content')
    {{-- Multiple Select --}}
    <link href="{{asset('public/css/jquery-ui.multidatespicker.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/css/jquery-ui.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-detached">
        <div class="content-detached">
            <!-- 2 columns form -->
            <form method="POST"
                  action="{{ url('properties'.(empty($property) ? '': '/' . $property->id)) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Property Details</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group {{ $errors->has('property_area') ? ' has-error' : '' }}">
                                                <label>Property Area</label>
                                                <select class="select" name="property_area">
                                                    <option value=""
                                                    >Select Property Area
                                                    </option>
                                                    @foreach($property_areas as $type)
                                                        <option value="{{$type->id}}" @if (old('property_area') == $type->id || isset($property) && $property->property_area_id==$type->id) selected="selected" @endif
                                                        >{{$type->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('property_area'))
                                                    <span class="help-block"><strong>{{ $errors->first('property_area') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="select" name="type">
                                                    <option value="rent" {{ old('type', @$property->type) == 'rent' ? 'selected="selected"':'' }}>
                                                        Rental
                                                    </option>
                                                    <option value="self" {{ old('type', @$property->type) == 'self' ? 'selected="selected"':'' }}>
                                                        Self
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label>Marla</label>
                                                <select class="select" name="marla">
                                                    <option value="less than 10" {{ old('marla', @$property->marla) == 'less than 10' ? 'selected="selected"':'' }}>
                                                        less than 10
                                                    </option>
                                                    <option value="10 to 20" {{ old('marla', @$property->marla) == '10 to 20' ? 'selected="selected"':'' }}>
                                                        10 to 20
                                                    </option>
                                                    <option value="greater than 20" {{ old('marla', @$property->marla) == 'greater than 20' ? 'selected="selected"':'' }}>
                                                        greater than 20
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group {{ $errors->has('house_no') ? ' has-error' : '' }}">
                                                <label>house_no <span class="text-danger">*</span></label>
                                                <input type="text" name="house_no" value="{{old('house_no', @$property->house_no)}}"   placeholder="House no" class="form-control" >
                                                @if ($errors->has('house_no'))
                                                    <span class="help-block"><strong>{{ $errors->first('house_no') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label>Address <span class="text-danger">*</span></label>
                                                <input type="text" name="address" value="{{old('address', @$property->address)}}"  placeholder="Address" class="form-control">
                                                @if ($errors->has('address'))
                                                    <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                                    <label>Departments</label>
                                                    <select  class ="form-control selectpicker"  name="departments[]" multiple>
                                                        @php ($i = 0)
                                                        @foreach($departments as $department)
                                                            @if (empty($property))
                                                                <option value="{{$department->id}}"
                                                                >{{$department->name. ' ('.$department->tax.' tax )'}}
                                                                </option>
                                                            @else
                                                                @if ((count($pro_dept))>0))
                                                                <option {{$department->id == $pro_dept[$i]->department_id ? 'selected': ''}} value={{$department->id}}>
                                                                    {{$department->name. ' ('.$department->tax.' tax )'}}
                                                                </option>
                                                                <?php if( $i <  (count($pro_dept)-1))
                                                                    $i++;
                                                                ?>
                                                                @else
                                                                    <option value="{{$department->id}}"
                                                                    >{{$department->name. ' ('.$department->tax.' tax )'}}
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                    </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="text-right">
                            @if(!empty($property)) {!! method_field('PUT') !!} @endif
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                @if(empty($property)) Save @else Update
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
    {{-- Multiple Select --}}
    <script type="text/javascript" src="{{asset('public/js/bootstrap-select.min.js')}}"></script>

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/moment/moment.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/pages/form_select2.js')}}"></script>



    <script type="text/javascript" src="{{asset('public/assets/js/plugins/visualization/echarts/echarts.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/user_profile_tabbed.js')}}"></script>
    <!-- /theme JS files -->


@endsection
