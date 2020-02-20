@extends('layouts.admin')

@section('header-content')
    <link rel="stylesheet" href="{{asset('public/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/buttons.dataTables.min.css')}}">
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-search4 text-size-base position-left"></i>
                Filter
            </div>
        </div>

        <div class="panel-body">
            <form method="GET" action="{{ Request::url() }}">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group ">
                            <select class="select selector form-control" name="citizen"  >
                                <option value=""
                                >Select Citizen
                                </option>
                                @foreach($citizens as $citizen)
                                    <option value="{{$citizen->id}}" {{ Request::get('citizen') == $citizen->id ? 'selected="selected"':'' }}
                                    >{{$citizen->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-danger" id="clear">
                            <i class="icon-trash text-size-base position-left"></i>
                            Clear
                        </button>
                        <button type="submit" class="btn bg-blue">
                            <i class="icon-search4 text-size-base position-left"></i>
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">All Payments</h5>
            </div>
            @if(!empty($payments[0]))
              <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-framed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($payments as $key=>$payment)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$payment->date}}</td>
                            <td>{{$payment->type}}</td>
                            <td>
                                @if($payment->type=='Credit')
                                {{$payment->account_number}}
                                @endif
                            </td>
                            <td>
                                @if($payment->type=='Credit')
                                {{$payment->amount}}
                                @else
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal{{$key}}">Payment Slip </button>
                                    <!-- Success modal -->
                                    <div id="modal{{$key}}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h6 class="modal-title">Payment Slip Response </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" align="center">
                                                            <img src="{{$payment->payment_slip}}" height="300px">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- /success modal -->

                                @endif
                            </td>
                            <td>
                                @if($payment->status=="Completed")
                                    <p style="color: #00a65a"> {{$payment->status}}</p>
                                @elseif($payment->status=="Rejected")
                                    <p style="color: #FF0000"> {{$payment->status}}</p>
                                @else
                                    {{$payment->status}}
                                @endif
                            </td>
                            <td>
                                @if($payment->status=="Pending")
                                    <ul class="icons-list" align="center">
                                        <li class="text-primary-600"><a title="Confirm Payment Received" href="javascript:;" onclick="confirm_Payment('{{url('payments/confirm/'.$payment->id)}}');" ><i class="glyphicon glyphicon-ok"></i></a></li>
                                        <li class="text-danger-600"><a title="Reject Payment " href="javascript:;" onclick="cancel_Payment('{{url('payments/cancel/'.$payment->id)}}');" ><i class="glyphicon glyphicon-remove"></i></a></li>
                                    </ul>
                                    <form id="paymentForm" method="GET" action="">
                                        {!! csrf_field() !!}
                                    </form>
                                 @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
            @else
                <div class="panel-body">
                    <p>No Records Found</p>
                </div>
            @endif
        </div>
        <!-- /bordered panel body table -->
@endsection

@section('footer-content')
    <script src="{{asset('public/assets/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/assets/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/buttons.print.min.js')}}"></script>
<script>
    function deleteItem(url) {
        if ($('#deleteForm').length > 0) {
            if (confirm('Are you sure you want to delete this?')) {
                $('#deleteForm').attr('action', url);
                $('#deleteForm').submit();
            }
        }
    }
</script>
<script>
    $(document).ready(function() {
        var total= $('#total_tax').val();
        $('#example').DataTable( {
            dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print'
//                ]

        } );
    } );
</script>
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
