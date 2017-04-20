function load_unseen_notification(view = '') {
    $.ajax({
        url:"notifications.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data) {
            $('.dropdown-menu.notification').html(data.notification);
            if(data.unseen_notification > 0) {
                $('.count').html(data.unseen_notification);
            }
        }
    });
}
