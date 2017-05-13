$(document).ready(function () {

    load_unseen_notification();

    setInterval(function(){
        load_unseen_notification();
    }, 5000);

    function load_unseen_notification() {
        $.ajax({
            url: "../messageCounter.php",
            method: "POST",
            success: function (data) {
                $('#notificationCounter').html(data);
                if(data.contains("0")) {
                    $("#messageAlert").css("display","none");
                    $("#notificationIcon").css("display", "none");
                    document.title = "snapSync";
                } else {
                    $("#messageAlert").css("display","block");
                    $("#notificationIcon").css("display", "block");
                    document.title = "snapSync - Neue Nachricht erhalten";
                }
            }
        });

    }

});
