@extends('admin::layouts.app')


@section('include_css')
    <!-- Data Tables -->
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h5> Config Category list</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul class="right-stats" id="mini-nav-right">
                        @can('MANAGE_CONFIG_CATEGORIES')
                            <a href="{{url('admin/config_categories/create')}}" class="btn btn-primary">
                                <i class="fa fa-plus" aria-hidden="true">

                                </i> Add New Config category</a>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="config_categories_list_table"
                                       class="table table-striped table-bordered no-margin"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>{{ __('common.labels.action')}}</th>


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

@section('include_js')

    <script src="{{ asset('/plugins/jquery_confirm/jquery-confirm.js')}}"></script>


@endsection

@section('custom_script')
    <script>
        $(document).ready(function () {
            var config_categories_list_table = $('#config_categories_list_table').DataTable({
                processing: true,
                serverSide: true,
                "order": [[0, 'desc']],
                'iDisplayLength': 15,
                ajax: '{!! route('get.all_config_categories') !!}',
                columns: [
                    {data: 'id', name: 'id', 'bVisible': false},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script>
@endsection
