@extends('layouts.admin')

@section('header-content')

@endsection
@section('content')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">All My Complain</h5>
            </div>
            @if(!empty($complains[0]))
              <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-framed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Complain</th>
                            <th>Response</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($complains as $key=>$complain)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{strip_tags($complain->complain)}}</td>
                            <td>{{strip_tags($complain->response)}}</td>
                            <td>
                                @if($complain->status==0)
                                    <p style="color: #9d1e15">Pending</p>
                                @endif
                            </td>
                            <td>
                                <ul class="icons-list">
                                    <li class="text-primary-600"><a title="Modify" href="{{Request::url()}}/{{$complain->id}}/edit"><i class="icon-pencil7"></i></a></li>
                                    <li class="text-danger-600"><a title="Delete" href="javascript:;" onclick="deleteItem('{{Request::url()}}/{{$complain->id}}');"><i class="icon-trash"></i></a></li>
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
                    {{ $complains->links() }}
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
