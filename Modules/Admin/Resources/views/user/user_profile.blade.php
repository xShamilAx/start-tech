@extends('admin::layouts.app')


@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        @if(isset($user->id))
                            <h5>Update System Users</h5>
                        @else
                            <h5>Create System Users</h5>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="right-stats">
                            @if(isset($user->id))
                                <button href="javascript:void(0)" class="btn btn-warning"
                                        id="user-update-btn">Update</button>
                            @else
                                <button href="javascript:void(0)" class="btn btn-success"
                                        id="user-save-btn">Save</button>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form id="user_form" role="form" method="POST" action=""
                      class="form-horizontal user-form">

                    <div class="row">
                        @csrf
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id ?? '' }}">
                        <input type="hidden" name="user_code" id="user_code" value="{{ $user_code ?? '' }}">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-xs-4"
                                       for="user_name">User name</label>
                                <div class="col-xs-8">
                                    <input id="user_name" type="text"
                                           class="form-control validate[required]"
                                           name="user_name" value="{{ $user->username ?? '' }}" required
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4"
                                       for="name">First Name</label>
                                <div class="col-xs-8">
                                    <input id="first_name" type="text" class="form-control validate[required]" name="first_name"
                                           value="{{ $user->first_name ?? '' }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4"
                                       for="name">Last Name</label>
                                <div class="col-xs-8">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="{{ $user->last_name ?? '' }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-4"
                                       for="email">Email</label>
                                <div class="col-xs-8">
                                    <input id="email" type="email" class="form-control validate[required]" name="email"
                                           value="{{ $user->email ?? '' }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-4"
                                       for="phone">Phone No</label>
                                <div class="col-xs-8">
                                    <input id="phone" type="phone_no" class="form-control validate[required]" name="phone_no"
                                           value="{{ $user->phone_no ?? '' }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-4"
                                       for="email">Role</label>
                                <div class="col-xs-8">
                                    <input class="form-control validate[required]"
                                           value="{{ $user_role[0] ?? '' }}" required>
                                           </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('custom_script')

    <script>
        $(document).ready(function () {


            $('#role').append($('<option>', {
                value: '',
                text: 'Select User Role'
            }));

            $('#branch').append($('<option>', {
                value: '',
                text: 'Select Branch'
            }));


            if ($('#user_id').val() == '') {
                $('#role').val('');
                $('#branch').val('');
                $('#managers').val('');
            }

            $("#user-save-btn ,#user-update-btn").click(function (e) {
                var valid = $("#user_form").validationEngine('validate');
                if (valid != true) {
                    return false;
                }
                $('#user-save-btn').prop('disabled', true);
                var btn = $(this).attr("id");

                var params = {
                    user_details: $('#user_form').serialize(),
                };

                var method = '';
                var url = '';
                if ($('#user_id').val() != '') {
                    method = 'PUT';
                    url = BASE + 'admin/users/' + $('#user_id').val();
                } else {
                    url = BASE + 'admin/users';
                    method = 'POST';
                }

                e.preventDefault();
                $.ajax({
                    url: url,
                    type: method,
                    dataType: 'JSON',
                    data: $.param(params),
                    success: function (response) {
                        if (response.status == 'error') {
                            notification(response);

                            $('#user-save-btn').prop('disabled', false);
                        } else {
                            notification(response);
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
