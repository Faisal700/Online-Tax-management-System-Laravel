@extends('layouts.admin')

@section('header-content')

@endsection
@section('content')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">All Complain</h5>
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
                                @else
                                    <p style="color: #00a65a">Completed</p>

                                @endif
                            </td>
                            <td>
                                @if($complain->status==0)
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal{{$key}}">Response</button>
                                @endif
                            </td>
                        </tr>
                        <!-- Success modal -->
                        <div id="modal{{$key}}" class="modal fade">
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
