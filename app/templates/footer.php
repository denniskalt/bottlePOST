<?php/* } else {*/ ?>
  <!--S  <div class="container-fluid">
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
                    <div id="desc-firmname" class="desc">Bitte <a href="index.php">loggen</a> Sie sich ein.</small></div>
                </div>
            </div>
        </div>
    </div>-->
    <?php /*} */?>
 <div class='notifications bottom-right'></div>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../inc/localstorage.js" type="application/javascript"></script>
<script type="text/javascript">
    saveLocalStorage('<?php echo $email ?>', '<?php echo $profilepic ?>', '<?php echo $username ?>', '<?php echo $vorname ?>', '<?php echo $nachname ?>');
</script>
<script>
 $('.bottom-right').notify({
    message: { text: 'Aw yeah, It works!' }
  }).show(); // for the ones that aren't closable and don't fade out there is a .hide() function.
</script>
</body>
</html>