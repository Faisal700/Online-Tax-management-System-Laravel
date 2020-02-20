@extends('layouts.admin')

@section('header-content')

@endsection
@section('content')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">All Departments</h5>
            </div>
            @if(!empty($departments[0]))
              <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-framed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Tax</th>
                            <th>Created at</th>
                            @if(Auth::user()->role=='Admin')
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $key=>$department)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$department->name}}</td>
                            <td>{{$department->tax}}</td>
                            <td>{{$department->created_at}}</td>
                            @if(Auth::user()->role=='Admin')
                            <td>
                                <ul class="icons-list">
                                    <li class="text-primary-600"><a title="Modify" href="{{Request::url()}}/{{$department->id}}/edit"><i class="icon-pencil7"></i></a></li>
                                    <li class="text-danger-600"><a title="Delete" href="javascript:;" onclick="deleteItem('{{Request::url()}}/{{$department->id}}');"><i class="icon-trash"></i></a></li>
                                </ul>
                                <form id="deleteForm" method="POST" action="">
                                    {!! method_field('DELETE') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div align="center">
                    {{ $departments->links() }}
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
