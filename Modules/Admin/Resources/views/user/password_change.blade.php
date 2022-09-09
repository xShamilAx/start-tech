@extends('admin::layouts.app')


@section('include_css')

@endsection

@section('content')
    <!-- Dashboard wrapper starts -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h4>Change Password</h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form id="settings_form" method="post" action="" class="form-horizontal">


                    <div class="form-group">
                        <label for="jobpositions" class="control-label col-xs-4">Current Password</label>
                        <div class="col-xs-8">
                            <input type="password" class="form-control validate[required]"
                                   id="current_password" placeholder="Enter Current Password"
                                   value="" name="current_password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-4" for="jobpositions">New Password</label>
                        <div class="col-xs-8">
                            <input type="password" class="form-control validate[required]"
                                   id="password" placeholder="Enter New Password" value=""
                                   name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-4" for="jobpositions">Confirm New Password</label>
                        <div class="col-xs-8">
                            <input type="password" class="form-control validate[required]"
                                   id="password_confirmation" placeholder="Confirm Password"
                                   value="" name="password_confirmation">
                        </div>
                    </div>



                    <div class="col-sm-4">
                        <button type="button" class="btn btn-primary" id="btn_update"
                                name="btn_update">Update
                        </button>


                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('custom_script')
    <script>
        $(document).ready(function () {
            $("#settings_form").validationEngine();

            $("#btn_update").click(function (e) {
                var valid = $("#settings_form").validationEngine('validate');
                if (valid != true) {
                    return false;
                }
                var btn = $(this).attr("id");
                var params = {
                    settings_details: $('#settings_form').serialize(),
                };

                var url;
                var method;

                url = BASE + 'admin/change_password';
                method = 'POST';

                e.preventDefault();
                $.ajax({
                    url: url,
                    type: method,
                    dataType: 'JSON',
                    data: $.param(params),
                    success: function (response) {
                        if (response.status == 'error') {
                            notification(response);
                        } else {
                            notification(response);
                            /*
                             $('#set_code').val(response.code);
                             $('#settings_id').val(response.id);*/
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

@section('include_js')


@endsection
