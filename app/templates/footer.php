<?php if(login_check($mysqli) == false) { ?>
    <div class="container-fluid">
        <div class="row-fluid" id="login-container">
            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 tab-head">
                <div class="cardheader">
                    <div id="time"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div id="tab-wrapper" class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 card">
                <div class="info">
                    <div id="title-name" class="title">Sie sind nicht berechtigt, diese Seite zu besuchen.</div>
                    <div id="desc-firmname" class="desc">Bitte <a href="http://localhost/bottlepost/index.php">loggen</a> Sie sich ein.</small></div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
 <div class='notifications bottom-right'></div>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="inc/localstorage.js" type="application/javascript"></script>
<script src="inc/like-dislike.js"></script>
<script type="text/javascript">
    saveLocalStorage('<?php echo $email ?>', '<?php echo $profilepic ?>', '<?php echo $username ?>', '<?php echo $vorname ?>', '<?php echo $nachname ?>');
</script>
<script src="inc/notifications/load-notifications.js" type="application/javascript"></script>
<!--<script type="text/javascript">

var xmlHttpObject = false;
if (typeof XMLHttpRequest != 'undefined') {
    xmlHttpObject = new XMLHttpRequest();
}
if (!xmlHttpObject) {
    try {
        xmlHttpObject = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e) {
        try {
            xmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e) {
            xmlHttpObject = null;
        }
    }
}

function loadContent() {
    xmlHttpObject.open('get','notifications.php');
    xmlHttpObject.onreadystatechange = handleContent;
    xmlHttpObject.send(null);
    return false;
}

function handleContent() {
    if (xmlHttpObject.readyState == 4)
    {
        document.getElementById('myContent').innerHTML = xmlHttpObject.responseText;
    }
}
</script>-->
<script>
$(document).ready(function(){
 load_unseen_notification();

 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(function(){
  load_unseen_notification();
 }, 5000);

});
</script>
<script>
    var text_max = 160;
$('#count_message').html(text_max + ' Zeichen übrig');

$('#posting').keyup(function() {
  var text_length = $('#posting').val().length;
  var text_remaining = text_max - text_length;

$('#count_message').html(text_remaining + ' Zeichen übrig');

});
</script>
<script>
$(function () {
   $('.panel-google-plus > .panel-footer > .input-placeholder, .panel-google-plus > .panel-google-plus-comment > .panel-google-plus-textarea > button[type="reset"]').on('click', function(event) {
        var $panel = $(this).closest('.panel-google-plus');
            $comment = $panel.find('.panel-google-plus-comment');

        $comment.find('.btn:first-child').addClass('disabled');
        $comment.find('textarea').val('');

        $panel.toggleClass('panel-google-plus-show-comment');

        if ($panel.hasClass('panel-google-plus-show-comment')) {
            $comment.find('textarea').focus();
        }
   });
   $('.panel-google-plus-comment > .panel-google-plus-textarea > textarea').on('keyup', function(event) {
        var $comment = $(this).closest('.panel-google-plus-comment');

        $comment.find('button[type="submit"]').addClass('disabled');
        if ($(this).val().length >= 1) {
            $comment.find('button[type="submit"]').removeClass('disabled');
        }
   });
});
</script>
</body>
</html>
