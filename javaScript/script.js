$(window).resize(function () {
    if (window.innerWidth <= 767) {
        if (!$('#dropdown-menu').hasClass('dropdown-menu-left')) {
            $('#dropdown-menu').addClass("dropdown-menu-left");
            $('#dropdown-menu').removeClass("dropdown-menu-right");

            console.log('ALoha');
        }
    }
    else {
        if (!$('#dropdown-menu').hasClass('dropdown-menu-right')) {
            $('#dropdown-menu').addClass("dropdown-menu-right");
            $('#dropdown-menu').removeClass("dropdown-menu-left");
        }
    }
});

$('#file').change(function () {
    var file = document.getElementById('file').files;
    if (file.length == 0) document.getElementById('foto').setAttribute("src", "/avatar/noAvatar.png");

    if (file.length > 0) {
        var file_reader = new FileReader();
        file_reader.onload = function () {
            document.getElementById('foto').setAttribute("src", event.target.result);
        };
        file_reader.readAsDataURL(file[0]);
    }
});

$('.update').click(function () {
    var d = new Date();
    var date = d.getFullYear() + '-' + ((d.getMonth() + 1) < 10 ? '0' + (d.getMonth() + 1) : (d.getMonth() + 1)) + '-' + (d.getDate() < 10 ? '0' + d.getDate() : d.getDate());

    $.post('/blog/updateItem', {
        id: $(this).val()
    }, function (data) {
        response = JSON.parse(data);

        if (response.status == 'success') {
            $("#date-" + response.id).text(date);
            $('#status-' + response.id).text("not approved");
            $('#commets-' + response.id).text("0");
            $("#update-" + response.id).attr('hidden', true);
        } else {
            alert("error");
        }
    });
});