@extends('layouts.admin')

@section('header-content')

@endsection
@section('content')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">All Citizens</h5>
            </div>
            @if(!empty($citizens[0]))
              <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-framed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Annual Income</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($citizens as $key=>$citizen)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$citizen->name}}</td>
                            <td>{{$citizen->email}}</td>
                            <td>{{$citizen->type}}</td>
                            <td>{{$citizen->annual_income}}</td>
                            <td>{{$citizen->address}}</td>
                            <td>{{$citizen->phone}}</td>
                            <td>
                                <ul class="icons-list">
                                    <li class="text-primary-600"><a title="Modify" href="{{Request::url()}}/{{$citizen->id}}/edit"><i class="icon-pencil7"></i></a></li>
                                    <li class="text-danger-600"><a title="Delete" href="javascript:;" onclick="deleteItem('{{Request::url()}}/{{$citizen->id}}');"><i class="icon-trash"></i></a></li>
                                </ul>
                                <form id="deleteForm" method="POST" action="">
                                    {!! method_field('DELETE') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div align="center">
                    {{ $citizens->links() }}
                </div>
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
@endsection
