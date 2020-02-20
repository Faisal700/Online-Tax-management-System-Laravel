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
                            @if($payment->payment_type=="Cheque")
                                <span class="text-primary-600 pull-right"><a title="Confirm Payment Received" href="javascript:;" onclick="confirm_Payment('{{url('payments/confirm/'.$payment->id)}}');" ><i class="glyphicon glyphicon-ok"></i></a></span>
                            <form id="paymentForm" method="GET" action="">
                                {!! csrf_field() !!}
                            </form>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td>Citizen Name</td>
                        <td>@if(isset($payment->user->name)){{$payment->user->name}} @endif  </td>
                        <td>Payment Type</td>
                        <td> {{$payment->type}}</td>
                    </tr>
                    <tr>
                        <td>Account Number</td>
                        <td>{{$payment->account_number}} </td>
                        <td>Amount</td>
                        <td>{{$payment->amount}}</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{$payment->date}}</td>
                        <td>Status</td>
                        <td>
                            @if($payment->status=="Completed")
                                <p style="color: #00a65a"> {{$payment->status}}</p>
                            @elseif($payment->status=="Rejected")
                                <p style="color: #FF0000"> {{$payment->status}}</p>
                            @else
                                {{$payment->status}}
                            @endif
                        </td>
                    </tr>
                    @if($payment->type=="Printout")
                    <tr>
                        <td>Payment Slip</td>
                        <td colspan="3" align="center">
                        <img src="{{$payment->payment_slip}}" height="250px">
                        </td>
                    </tr>
                    @endif
                    @if($payment->status=="Pending")
                    <tr>
                        <td>Action</td>
                        <td colspan="3">

                                <ul class="icons-list" align="center">
                                    <li class="text-primary-600"><a title="Confirm Payment Received" href="javascript:;" onclick="confirm_Payment('{{url('payments/confirm/'.$payment->id)}}');" ><i class="glyphicon glyphicon-ok"></i></a></li>
                                    <li class="text-danger-600"><a title="Reject Payment " href="javascript:;" onclick="cancel_Payment('{{url('payments/cancel/'.$payment->id)}}');" ><i class="glyphicon glyphicon-remove"></i></a></li>
                                </ul>
                                <form id="paymentForm" method="GET" action="">
                                    {!! csrf_field() !!}
                                </form>

                        </td>
                    @endif
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection
@section('footer-content')
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

