$(document).ready(function () {

    $('.chatContact').click(function () {

        $('#chatLoader').empty();
        var title = $(this).attr("title");
        $('#recieverID').val(title);
        readChat(title);

    });

    function readChat(id) {

        $.ajax({
            type: "GET",
            url: 'readChat.php',
            data: {
                q: id
            },

            success: function (data) {
                $('#chatLoader').html(data);
            }
        });
    };

});
