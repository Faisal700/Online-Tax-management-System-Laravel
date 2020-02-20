@extends('layouts.admin')

@section('header-content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
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
        <div class="container-fluid">

            @if(!empty($reports[0]))
                <h2 align="center"> <b >Total Tax</b> {{$total_tax}}
                </h2>
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                <tr>
                    <input type="hidden" id="total_tax" value="{{$total_tax}}">
                    <th colspan="3"></th>
                    <th>Total Tax</th>
                    <th  >{{$total_tax}}</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Area</th>
                    <th>House #</th>
                    <th>Type</th>
                    <th>Departments</th>
                    <th>Marla</th>
                    <th>Tax</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $key=> $tax)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$tax['area']}}</td>
                    <td>{{$tax['house_no']}}</td>
                    <td>{{$tax['type']}}</td>
                    <td>{{$tax['departments']}}</td>
                    <td>{{$tax['marla']}}</td>
                    <td>{{$tax['tax']}}</td>
                </tr>
                @endforeach
                </tfoot>
            </table>
            @else
                <h2 > <b >Taxation Report</b>
                </h2>
                <br>

                <div class="panel-body">
                    <p>No Records Found</p>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('footer-content')

    {{--Data table --}}
    <script src="{{asset('public/assets/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/assets/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/assets/datatable/buttons.print.min.js')}}"></script>
    {{----}}

    <script>
        $(document).ready(function() {
            var total= $('#total_tax').val();
            $('#example').DataTable( {
                dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print'
//                ]
                buttons: [
                    'copy',
                    {
                        extend: 'csv',
                        messageTop: 'Total Tax : '+total
                    },
                    {
                        extend: 'excel',
                        messageTop: 'Total Tax : '+total
                    },
                    {
                        extend: 'pdf',
                        messageTop: 'Total Tax : '+total
                    },
                    {
                        extend: 'print',
                        messageTop: 'Total Tax : '+total
                    },
                ]
            } );
        } );
    </script>
@endsection
