$(document).ready(function() {

    $('#test').click(function(){

        $('#retweet-body').empty();
        var title = $(this).attr("title");
        retweet(title);
        $('#tweetModal').modal({show:true});

    });

    function retweet(title) {
         $.ajax({
            url: "../retweet.php",
            method: "GET",
            data: {q: title},
            success: function (data) {
                $('#retweet-body').html(data);
            }
        });
    };

});
