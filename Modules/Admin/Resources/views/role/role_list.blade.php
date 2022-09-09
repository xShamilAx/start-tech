@extends('admin::layouts.app')


@section('include_css')
    <!-- Data Tables -->

@endsection

@section('content')
    <!-- Dashboard wrapper starts -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h5>User Roles</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="right-stats" id="mini-nav-right">
{{--                            @can('ADD_ROLE')--}}
                                    <a href="{{url('admin/roles/create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Role</a>
{{--                            @endcan--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="customerListTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Role name</th>
                            <th>Role display name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_script')
    <script>
        $(document).ready(function () {
            $('#customerListTable').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, "desc"]],
                'iDisplayLength': 15,
                ajax: '{!! route('get.user_roles') !!}',
                columnDefs: [
                    {className: 'text-center', targets: [4]},
                ],
                columns: [
                    {data: 'id', name: 'id', 'bVisible': false},
                    {data: 'name', name: 'name'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action'},
                ]
            });


        });
    </script>
@endsection
