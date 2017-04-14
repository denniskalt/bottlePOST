<?php
session_start();
include_once('config.php');
include_once('functions.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Die Web-Geeks" />
    <meta name="description" content="PHP-Praktikum - Erfahre alles zu den Leuten aus Deiner Umgebung." />

    <title>PHP-Praktikum</title>

    <!-- Bootstrap -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Responsive -->
    <meta name="viewport" content="width=devide-width, initial-scale=1.0" />

    <!-- Custom Styles -->
    <link href="../../styles/style.css" rel="stylesheet" />

    <!-- Icon -->
    <link rel="shortcut icon" href="../../images/logo.png" type="image/png" />
    <link rel="icon" href="../../images/logo.png" type="image/png" />
    <link rel="apple-touch-icon-precomposed" href="../../images/icon.png" type="image/png" />

    <!-- Fonts -->
    <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
</head>
    <?php
        $bg = 'success.jpg';
        $design = 'default';
    ?>
<body style="background-image: url(../../images/bg/<?php echo $bg ?>);" onload="window.setInterval('updateTime()',100)">
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
                    <div id="title-name" class="title">Passwort wurde zurückgesetzt!</div>
                    <div id="desc-firmname" class="desc">Es wurde eine Mail an Deine angegebene E-Mail-Adresse versendet.<br/><small style="text-decoration: underline;">Zu Demozwecken wurde eine Alternative entwickelt. Bitte klicke hierfür den Button.</small></div>
                </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aktivierung</h4>
      </div>
      <div class="modal-body">
        <p>Dies ist eine Anzeige, um den Registrierungsprozess zu Demonstrationszwecken zu verschlanken.</p>
        <p>Somit muss kein Mailserver eingerichtet werden und auf die mail()-Funktion kann verzichtet werden.</p>
        <p>In der endgültigen Version würde dies entfernt werden und während des Registrierungsprozesses wird eine E-Mail an die vom User eingegebene E-Mail-Adresse gesendet, in der der Aktivierungscode sowie der Link zum Aktivieren enthalten ist.</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" href="activation-link.php">Zum Aktivierungscode</a>
      </div>
    </div>

  </div>
</div>
                <div id="sign-in-content" class="tab-content">
				    <div class="group">
                        <input type="submit" class="btn btn-info btn-lg button" data-toggle="modal" data-target="#myModal" value="Aktivierung durchführen" />
                    </div>
                </div>
                <div id="sign-in-content" class="tab-content">
                <form id="login" action="pwreset.php" method="post" name="login">
                </form>
                    <div class="group">
                        <label for="email" class="label">E-Mail-Adresse</label>
                        <input id="email" name="email" type="email" class="input" form="login">
                    </div>
                    <div class="group">
					   <label for="password" class="label">Passwort</label>
					   <input id="passwordsignup" type="password" name="password" class="input" data-type="password" form="login">
                    </div>
                    <div class="progress">
				        <div id="complexity-bar" class="progress-bar" role="progressbar"><h1 id="complexity" class="pull-right">Ihr Passwort ist zu <span class="complexity-value">0%</span> sicher!</h1></div>
				    </div>
				    <div class="group">
                        <input type="submit" class="button" name="pwbtn" value="Passwort ändern" form="login">
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../clock.js" type="application/javascript"></script>
    <script src="hidepw.js"></script>
<script>
    $('#passwordsignup').hidePassword(true);
</script>
<script type="text/javascript" src="jquery.complexify.js"></script>
<script type="text/javascript">
  (function($) {

	$('#passwordsignup').complexify({}, function (valid, complexity) {
		var progressBar = $('#complexity-bar');

		progressBar.toggleClass('progress-bar-success', valid);
		progressBar.toggleClass('progress-bar-danger', !valid);
		progressBar.css({'width': complexity + '%'});

		$('.complexity-value').text(Math.round(complexity) + '%');
	});

})(jQuery);
</script>
</body>
</html>
