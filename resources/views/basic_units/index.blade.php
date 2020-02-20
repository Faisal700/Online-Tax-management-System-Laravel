@extends('layouts.admin')

@section('header-content')

@endsection
@section('content')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">All Basic Unit</h5>
            </div>
            @if(!empty($basic_units[0]))
              <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-framed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($basic_units as $key=>$basic_unit)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$basic_unit->name}}</td>
                            <td>{{$basic_unit->unit}}</td>
                            <td>
                                <ul class="icons-list">
                                    <li class="text-primary-600"><a title="Modify" href="{{Request::url()}}/{{$basic_unit->id}}/edit"><i class="icon-pencil7"></i></a></li>
                                    <li class="text-danger-600"><a title="Delete" href="javascript:;" onclick="deleteItem('{{Request::url()}}/{{$basic_unit->id}}');"><i class="icon-trash"></i></a></li>
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
