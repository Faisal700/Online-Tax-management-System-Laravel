@extends('layouts.admin')

@section('content')
    <div class="container-detached">
        <div class="content-detached">
            <!-- 2 columns form -->
            <form method="POST"
                  action="{{ url('payments'.(empty($payment) ? '': '/' . $payment->id)) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Payment Information</h5>
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
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                                                <label>Date <span class="text-danger">*</span></label>
                                                <input type="date" name="date" value="{{old('date', @$payment->date)}}"    class="form-control">
                                                @if ($errors->has('date'))
                                                    <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label>Payment Type</label>
                                                <select class="select" name="type" id="type">
                                                    <option value="Credit" {{ old('type', @$payment->type) == 'Credit' ? 'selected="selected"':'' }}>
                                                        Credit
                                                    </option>
                                                    <option value="Printout" {{ old('type', @$payment->type) == 'Printout' ? 'selected="selected"':'' }}>
                                                        Printout
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                            <div class="col-md-4 col-sm-4 credit" style="display: none">
                                                <div class="form-group {{ $errors->has('account_number') ? ' has-error' : '' }}">
                                                    <label>Account Number <span class="text-danger">*</span></label>
                                                    <input type="text" name="account_number" value="{{old('account_number', @$payment->account_number)}}"  placeholder="Account Number" class="form-control">
                                                    @if ($errors->has('account_number'))
                                                        <span class="help-block"><strong>{{ $errors->first('account_number') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 credit" style="display: none">
                                            <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                                <label>Amount <span class="text-danger">*</span></label>
                                                <input type="number" name="amount" value="{{old('amount', @$payment->amount)}}"  placeholder="Amount" class="form-control">
                                                @if ($errors->has('amount'))
                                                    <span class="help-block"><strong>{{ $errors->first('amount') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 printout" >
                                            @if(!empty($payment->payment_slip))
                                                <img src="{{$payment->payment_slip}}" style="height:150px!important;text-align: center " alt="">
                                            @endif
                                            <div class="form-group {{ $errors->has('payment_slip') ? ' has-error' : '' }}">
                                                <label>Attach Payment Slip:</label>
                                                <input type="file" name="payment_slip" class="file-styled">
                                                @if ($errors->has('payment_slip'))
                                                    <span class="help-block"><strong>{{ $errors->first('payment_slip') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="text-right">
                            @if(!empty($payment)) {!! method_field('PUT') !!} @endif
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                @if(empty($payment)) Save @else Update
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
    <script>
        $(document).ready(function() {
            $('#type').trigger("change");
        });

    </script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/moment/moment.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/assets/js/plugins/visualization/echarts/echarts.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/user_profile_tabbed.js')}}"></script>
    <!-- /theme JS files -->
    <script>
        $(document).on("change", '#type', function () {
            var id =$(this).val();
            if($(this).val()=="Credit"){
                $('.credit').show();
                $('.printout').hide();
            }else{
                $('.credit').hide();
                $('.printout').show();
            }

        });
    </script>


@endsection
