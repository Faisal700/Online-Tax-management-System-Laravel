@extends('layouts.admin')
@section('header-content')
<style>
    .center {
        text-align: center!important;
    }
    .size{
        font-size: 18px;
    }

</style>
@endsection
@section('content')
    <div class="panel panel-flat">
            <div class="table-responsive">
                <table class="table table-bordered table-lg">
                    <tbody>
                    <tr class="">
                        <th colspan="4" class="center size" ><b>Payment Detail</b>
                            @if($complain->payment_type=="Cheque")
                                <span class="text-primary-600 pull-right"><a title="Confirm Payment Received" href="javascript:;" onclick="confirm_Payment('{{url('payments/confirm/'.$complain->id)}}');" ><i class="glyphicon glyphicon-ok"></i></a></span>
                            <form id="paymentForm" method="GET" action="">
                                {!! csrf_field() !!}
                            </form>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td>Citizen Name</td>
                        <td>@if(isset($complain->user->name)){{$complain->user->name}} @endif  </td>
                        <td>Status</td>
                        <td>
                            @if($complain->status==0)
                                <p style="color: #9d1e15">Pending</p>
                            @else
                                <p style="color: #00a65a">Completed</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Complain</td>
                        <td colspan="3">{{$complain->complain}} </td>
                    </tr>
                    <tr>
                        <td>Response</td>
                        <td colspan="3">
                            @if($complain->status==0)
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal1">Response</button>
                        @else
                            {{$complain->response}}
                        @endif
                            <!-- Success modal -->
                                <div id="modal1" class="modal fade">
                                    <form method="POST"
                                          action="{{ url('complains/response/'.$complain->id) }}"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h6 class="modal-title">Complain Response </h6>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group ">
                                                                <label>Response</label>
                                                                <textarea cols="10" rows="10" name="response" class="wysihtml5 wysihtml5-min form-control" placeholder="Enter Response ...">
                                                        {{old('response', @$complain->response)}}
									               </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /success modal -->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
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

    <script>
        function confirm_Payment(url) {
            if ($('#paymentForm').length > 0) {
                if (confirm('Are you sure you want to Received this Payment?')) {
                    $('#paymentForm').attr('action', url);
                    $('#paymentForm').submit();
                }
            }
        }
        function cancel_Payment(url) {
            if ($('#paymentForm').length > 0) {
                if (confirm('Are you sure you want to Reject this Payment?')) {
                    $('#paymentForm').attr('action', url);
                    $('#paymentForm').submit();
                }
            }
        }
    </script>
@endsection

