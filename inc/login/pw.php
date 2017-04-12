<?php
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
                <div id="sign-in-content" class="tab-content">
                <form id="login" action="pw.php" method="post" name="login">
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
    <?php
    if(isset($_POST['pwbtn'], $_POST['password'])) {

        $email = $_POST["email"];
        $password = $_POST["password"];

        if(changePW($email, $password, $mysqli)) {
            echo "Jawoll";
        }
        else {
            echo "Nein";
        }

    }
?>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
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
