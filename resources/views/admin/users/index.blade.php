@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Manage Users</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="active">Manage Users</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    <div class="row">
        @include('admin.partials._msg')
        <div class="col-sm-12">
            <div class="white-box">
                <a class="btn btn-danger pull-right m-l-5" onclick="del_selected()" href="javascript:void(0)">
                    <i class="fa fa-trash"></i> Delete All
                </a>
                <a class="btn btn-success pull-right" href="{{route('users.create')}}">
                    <i class="fa fa-plus"></i> Add New
                </a>
                <h3 class="box-title m-b-0">Manage Users</h3>
                <p class="text-muted m-b-30">User List</p>
                <div class="table-responsive">
                    <form action="{{url('admin/delete-selected-users')}}" method="post" id="uform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table id="users" class="table table-striped responsive nowrap" width="100%">
                        <thead>
                        <th>
                            <div class="checkbox checkbox-success m-0">
                                <input type="checkbox">
                                <label for="checkbox3"></label>
                            </div>
                        <th>NAME</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Action</th>
                        </thead>
                    </table>
                    </form>
                </div>
                <!-- sample modal content -->
                <div id="userModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">User Detail</h4> </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>


    </div>
    </div>

@section('scripts')
    <script type="text/javascript">
        function del(id){
            swal({
                        title: "Are you sure?",
                        text: "This user will be deleted permanently",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var APP_URL = {!! json_encode(url('/')) !!}

                                window.location.href = APP_URL+"/admin/users/delete/"+id;
                    });

        }
        function del_selected(){
            swal({
                title: "Are you sure?",
                text: "These user/users will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $("#uform").submit();
                setTimeout(function () {
                    swal("Users deleted sucessfully. Thanks");
                }, 2000);
            });
        }
    </script>

    <script>

        $(document).on('click', 'th input:checkbox', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function () {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });

        var users = $('#users').DataTable( {
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url":"{{ route('admin.getUsers') }}",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":"<?php echo csrf_token() ?>"}
            },
            "columns":[
                {"data":"id","searchable":false,"orderable":false},
                {"data":"name"},
                {"data":"email"},
                {"data":"active"},
                {"data":"created_at"},
                {"data":"action","searchable":false,"orderable":false}
            ]
        } );
        function viewInfo(id) {
            $.LoadingOverlay("show");
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('admin.getUser') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#userModel').modal('show');
                $.LoadingOverlay("hide");

            });
        }
    </script>
@endsection
@stop
