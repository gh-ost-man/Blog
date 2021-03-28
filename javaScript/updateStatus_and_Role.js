$('.status').click(function () {
    $('#status-' + $(this).val()).text($(this).text());

    let host = window.location.protocol + "//" + window.location.host;

    let id = $(this).val();

    $.post(host + '/admin/updateStatusRecord', {
        id: id,
        status_record: $(this).text()

    }, function (data) {
        response = JSON.parse(data);
    });

    if ($(this).text() == 'delete') {
        $(`#delete-${id}`).attr('hidden', true);
    }
    switch ($(this).text()) {
        case 'delete':
            $(`#delete-${id}`).attr('hidden', true);
            break;
        case 'approved':
        case 'not approved':
            $(`#delete-${id}`).attr('hidden', false);
            break;
    }
});

$('.comment-status').click(function () {
    $('#status-comment-' + $(this).val()).text($(this).text());

    let host = window.location.protocol + "//" + window.location.host;

    let id = $(this).val();

    $.post(host + '/admin/updateStatusComment', {
        id: id,
        status_comment: $(this).text()

    }, function (data) {
        response = JSON.parse(data);
    });

    if ($(this).text() == 'delete') {
        $(`#delete-comment-${id}`).attr('hidden', true);
    }
    switch ($(this).text()) {
        case 'delete':
            $(`#delete-comment-${id}`).attr('hidden', true);
            break;
        case 'approved':
        case 'not approved':
            $(`#delete-comment-${id}`).attr('hidden', false);
            break;
    }
});

$('.role-user').click(function () {
    $('#role-user-' + $(this).val()).text($(this).text());
   
    let id = $(this).val();
   
    $.post(host + '/admin/updateRole', {
        id: id,
        role: $(this).text()

    }, function (data) {
        response = JSON.parse(data);
    });
})