@extends('layouts.admin')

@section('header-content')
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet" href="{{asset('public/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/buttons.dataTables.min.css')}}">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">--}}
@endsection
@section('content')

    <div class="panel panel-flat">
        <div class="container-fluid">
            <h2 align="center"> <b >Total Tax</b> {{$total_tax}}
            </h2>
            <br>
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
                @foreach($all_tax as $key=> $tax)
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
        </div>
    </div>

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
