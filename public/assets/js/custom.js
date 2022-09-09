// scrollUp full options
function notification(response) {

    var msg_type;

    if (response.status == 'error') {
        msg_type = 'danger';
    } else {
        msg_type = 'success';
    }

    if (response.msg != undefined) {

        $.notify({
            // options
            message: response.msg
        }, {
            // settings
            z_index: 10000000000,
            type: msg_type,

        });
    } else if (response.errors != undefined) {

        $.each(response.errors, function (key, value) {
            $.notify({
                // options
                message: value
            }, {
                // settings
                z_index: 10000000000,
                type: msg_type,

            });
//
        });
    }

}

function notificationError(xhr, ajaxOptions, thrownError) {

    if (xhr.status == 403) {
        $.notify({
            // options
            message: '403 : Unauthorized action.'
        }, {
            // settings
            z_index: 100000,
            type: 'danger',

        });


    } else {
        $.notify({
            // options
            message: 'Oops! Something went wrong'
        }, {
            // settings
            z_index: 100000,
            type: 'danger',

        });
    }

}


$(document).ready(function () {

    $("#txtEditor").Editor();

    $('#change_user_theme').click(function (e) {
        var params = {};
        e.preventDefault();
        $.ajax({
            url: BASE + 'change_user_theme',
            type: 'POST',
            dataType: 'JSON',
            data: $.param(params),
            success: function (response) {

                if (response.status == 'success') {
                    location.reload();

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


window.disable_save_button_group = {
    run: function () {
        $(':button').prop('disabled', true);
    }
};

window.enable_save_button_group = {
    run: function () {
        $(':button').prop('disabled', false);
    }
};


$(document).ajaxStart(function () {
    disable_save_button_group.run();
}).ajaxStop(function () {
    enable_save_button_group.run();
});

//comment section JS

var CommentsListTable = $('#CommentsListTable').DataTable({
    searching: false,
    paging: false,
    responsive: true,
    "order": [[0, 'desc']],
    serverSide: true,
    ajax: BASE + 'get_comments_list/' + $('#ref_type').val() + '/' + $('#ref_id').val(),
    bInfo: false,

    columns: [
        {data: 'id', name: 'id', 'bVisible': false},
        {data: 'created_at', name: 'created_at'},
        {data: 'comments', name: 'comments'},
        {data: 'user', name: 'user'},
    ]
});


$("#comment_save_btn").click(function (e) {
    var params = {

        ref_id: $('#ref_id').val(),
        ref_type: $('#ref_type').val(),
        comment: $('#txtEditor').Editor("getText")
    };
    e.preventDefault();
    $.ajax({
        url: BASE + 'save_comment',
        type: 'POST',
        dataType: 'JSON',
        data: $.param(params),
        success: function (response) {

            CommentsListTable.ajax.url(BASE + 'get_comments_list/' + $('#ref_type').val() + '/' + $('#ref_id').val()).load();
            $("#txtEditor").Editor("setText", "");

        }

    });
    e.preventDefault();
    return false;
});
});


