@extends('admin::layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        @if(isset($config->id))
                            <h4>Update Config Category</h4>
                        @else
                            <h4>Create Config Category</h4>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <button href="javascript:void(0)" class="btn btn-danger"
                                id="config_category_save_btn">Save</button>
                        <button href="javascript:void(0)" class="btn btn-primary"
                                id="config_category_save_and_new">Save and New</button>
                        <button href="javascript:void(0)" class="btn btn-warning"
                                id="config_category_update_btn">Update</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="{{url('/').'/admin/config_categories'}}" method="POST" id="create_config_category_form">
                        @csrf
                        <input type="hidden" id="config_category_id" name="config_category_id"
                               value="{{$config_category->id ?? ''}}">
                        <div class="card" id="customer-details-panel">
                            <div class="card-header">
                                <h4>Config Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label for="mobile">Config Category Name</label>
                                                <input type="text" class="form-control validate[required]"
                                                       id="config_categpry_name"
                                                       name="config_category_name"
                                                       value="{{ $config_category->name ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-check">

                                                    <label
                                                        for="telephone">Description</label>
                                                <textarea name="description" id="description"
                                                          class="form-control">{{$config_category->description ?? ''}}</textarea>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Status">Status</label>
                                            <br/>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio1"
                                                       name="status_radio" @if(!isset($config_category)) checked
                                                       @endif @if(isset($config_category) && $config_category->status==1) checked
                                                       @endif  value="1">
                                                <label for="customRadio1"
                                                       class="custom-control-label">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio2"
                                                       name="status_radio"
                                                       @if(isset($config_category) && $config_category->status==0) checked
                                                       @endif value="0">
                                                <label for="customRadio2"
                                                       class="custom-control-label">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Main container ends -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection

        @section('include_js')


        @endsection

        @section('include_css')

        @endsection

        @section('custom_script')

            <script>
                $(document).ready(function () {


                    if ($('#config_category_id').val() != '') {
                        $('#config_category_save_btn').hide();
                        $('#config_category_save_and_new').hide();
                    } else {
                        $('#config_category_update_btn').hide();
                    }


                    $("#config_category_save_btn ,#config_category_update_btn , #config_category_save_and_new").click(function (e) {
                        var valid = $("#create_config_category_form").validationEngine('validate');
                        if (valid != true) {
                            return false;
                        }

                        $('#config_category_save_btn ,#config_category_update_btn , #config_category_save_and_new').prop('disabled', true);

                        var btn = $(this).attr("id");

                        var config_category_details = $('#create_config_category_form').serialize();


                        var params = {
                            config_category_details: config_category_details,
                        };
                        var method = '';
                        var url = '';

                        if ($('#config_category_id').val() != '') {
                            method = 'PUT';
                            url = BASE + 'admin/config_categories/' + $('#config_category_id').val();
                        } else {
                            url = BASE + 'admin/config_categories';
                            method = 'POST';
                        }

                        e.preventDefault();
                        $.ajax({
                            url: url,
                            type: method,
                            dataType: 'JSON',
                            data: $.param(params),
                            success: function (response) {
                                if (response.status == 'success') {

                                    $('#config_category_id').val(response.category_id);

                                    if (btn == 'config_category_save_and_new') {
                                        notification(response);
                                        setTimeout(
                                            function () {
                                                window.location.href = BASE + 'admin/config_categories/create';
                                            }, 1000);
                                    }
                                    if (btn == 'config_category_save_btn') {

                                        notification(response);

                                        setTimeout(
                                            function () {
                                                window.location.href = BASE + 'admin/config_categories';
                                            }, 1000);
                                    }
                                    if (btn == 'config_category_update_btn') {
                                        notification(response);
                                        setTimeout(
                                            function () {
                                                window.location.href = BASE + 'admin/config_categories';
                                            }, 1000);
                                    }
                                } else {
                                    notification(response);
                                    $('#config_category_save_btn ,#config_category_update_btn , #config_category_save_and_new').prop('disabled', false);


                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                notificationError(xhr, ajaxOptions, thrownError);
                            }
                        });
                        e.preventDefault();
                        return false;
                    });


                });
            </script>
@endsection
