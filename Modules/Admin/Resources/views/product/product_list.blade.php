@extends('admin::layouts.app')

@section('content')
    <!-- Dashboard wrapper starts -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h5>Product List</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <ul class="right-stats" id="mini-nav-right">
                            @if (Auth::user()->can(['ADD_PRODUCT']))
                                <a href="{{url('admin/product/create')}}" class="btn btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true">

                                    </i> Add New Product</a>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <input type="hidden" name="page" id="page" value="{{ $page ?? '' }}">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="productListTable" class="table table-striped table-bordered no-margin" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Assigned User</th>
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
            var productListTable = $('#productListTable').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollCollapse: true,
                    orderClasses: false,
                    deferRender: true,
                    timeout: 60000,
                    order: [[0, "desc"]],
                    'iDisplayLength': 15,
                    ajax: '{!! route('get.products') !!}',
                    columns: [
                        {data: 'id', name: 'id', 'bVisible': false},
                        {data: 'product_name', name: 'product_name'},
                        {data: 'assigned_user', name: 'assigned_user'},
                        {data: 'product_description', name: 'product_description'},
                        {data: 'action', name: 'action'},
                    ]
                });

            $(document).on('click', '#delete_product', function (e) {
                var data = productListTable.row($(this).parents('tr')).data();
                var parent = $(this).parents('tr');
                var rowidx = productListTable.row(parent).index();
                var delete_confirm = $.confirm({
                    title: 'Delete Product Confirmation',
                    type: 'red',
                    buttons: {
                        delete: {
                            text: 'Delete',
                            keys: ['shift', 'alt'],
                            btnClass: 'btn-red',
                            action: function () {

                                e.preventDefault();
                                var params = {};

                                $.ajax({
                                    url: BASE + 'admin/product/' + data['id'],
                                    type: 'DELETE',
                                    dataType: 'JSON',
                                    data: $.param(params),
                                    success: function (response) {
                                        if (response.status == 'error') {

                                        } else {
                                            productListTable
                                                .row(parent)
                                                .remove()
                                                .draw();
                                            delete_confirm.close()

                                        }
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {

                                        notificationError(xhr, ajaxOptions, thrownError);
                                    }
                                });
                                e.preventDefault();
                                return false;
                            }
                        },
                        close: function () {
                        }
                    }
                });
            });

        });
    </script>
@endsection
