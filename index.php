<?php
    // Bei abgelegtem User direkt an den geschützten Bereich weiterleiten
    /*if(isset($_SESSION['user'])!="") {
        header("Location: SAFEAREA");
    }

    include_once 'inc/config.php';
    include_once 'inc/login/functions.php';*/
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Die Web-Geeks" />
    <meta name="description" content="PHP-Praktikum - Erfahre alles zu den Leuten aus Deiner Umgebung." />

    <title>PHP-Praktikum</title>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Responsive -->
    <meta name="viewport" content="width=devide-width, initial-scale=1.0" />

    <!-- Custom Styles -->
    <link href="styles/login.css" rel="stylesheet" />

    <!-- Icon -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png" />
    <link rel="icon" href="images/logo.png" type="image/png" />
    <link rel="apple-touch-icon-precomposed" href="images/icon.png" type="image/png" />

    <!-- Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
</head>
<?php
    $daytime[0] = "Guten Morgen!";
    $daytime[1] = "Guten Tag!";
    $daytime[2] = "Guten Abend!";
    $daytime[3] = "Gute Nacht!";

    $quote[0]['text']="Wir sind niemals am Ziel, sondern immer auf dem Weg.";
    $quote[0]['author']="Vinzenz von Paul";
    $quote[0]['img']="way";

    $quote[1]['text']="Wäre ich den Weg gegangen, den alle gegangen sind, wäre ich auch nur dort angekommen, wo alle angekommen sind.";
    $quote[1]['author']="Monika Majic";
    $quote[1]['img']="be-different";

    $quote[2]['text']="Die großen Augenblicke sind die, in denen wir getan haben, was wir uns nie zugetraut hätten.";
    $quote[2]['author']="Marie Freifrau von Ebner-Eschenbach";
    $quote[2]['img']="success";

    $quote[3]['text']="Positives Denken und der Glaube an sich selbst, sind der Weg zum Erfolg";
    $quote[3]['author']="Josef Dlask";
    $quote[3]['img']="faith";

    $quote[4]['text']="Es sind nicht unsere Fähigkeiten, die zeigen wer wir sind, sondern unsere Entscheidungen.";
    $quote[4]['author']="aus Harry Potter, Dumbledore (J.K.Rowling)";
    $quote[4]['img']="decisions";

    $quote[5]['text']="Move on. It´s a chapter in your life. Don´t close the book, just turn the page for a new chapter.";
    $quote[5]['author']="Brooklyn Copeland";
    $quote[5]['img']="chapter";

    $length = count($quote);
    $choice = (rand(1,$length))-1;
?>
<body onload="window.setInterval('updateTime()',100)" class="<?php echo $quote[$choice]['img'];?>">
    <div class="container-fluid">
        <div class="row-fluid" id="login-container">
            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 tab-head">
                <div class="cardheader">
                    <div id="time"></div>
                </div>
                <div class="avatar">
                    <img alt="Profilfoto" src="images/user.jpg" class="image-circle" id="avatar">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div id="tab-wrapper" class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 card">
                <div class="info">
                    <?php
                        $time = time();
                        $time = date("G", $time);
                        switch(TRUE) {
                            case ($time <= 12 AND $time >= 5):
                                echo '<div id="title-name" class="title">'.$daytime[0].'</div>';
                                break;
                            case ($time <= 17 AND $time > 12):
                                echo '<div id="title-name" class="title">'.$daytime[1].'</div>';
                                break;
                            case ($time <= 20 AND $time > 17):
                                echo '<div id="title-name" class="title">'.$daytime[2].'</div>';
                                break;
                            case ($time <= 24 AND $time > 20 OR $time >= 0 AND $time < 5):
                                echo '<div id="title-name" class="title">'.$daytime[3].'</div>';
                                break;
                        }
                    ?>
                    <div id="desc-firmname" class="desc">"<?php echo $quote[$choice]['text'];?>" <small>- <?php echo $quote[$choice]['author']?></small></div>
                </div>
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Register</label>
                <input id="tab-3" type="radio" name="tab" class="forgot-password"><label for="tab-3" class="tab" style="display: none;">Forgot?</label>
                <div id="sign-in-content" class="tab-content">
                <form id="login" action="inc/login/form-direct.php" method="post" name="login">
                </form>
                    <div class="group">
                        <label for="email" class="label">E-Mail-Adresse</label>
                        <input id="email" name="email" type="email" class="input" form="login">
                    </div>
				    <div class="group">
                        <label for="password" class="label">Passwort</label>
                        <input id="passwordlogin" name="password" type="password" class="input" data-type="password" form="login">
                    </div>
                    <!--<div class="group">
                        <label for="check" class="checkbox"> Remember Me
                            <input type="checkbox" checked name="remember" id="check" form="login">
                            <div class="control_ind"></div>
                        </label>
                    </div>
				    <div class="group">
                        <input type="submit" class="button" name="loginbtn" value="Login" form="login">
                    </div>

				    <div class="hr"></div>
				    <div class="footer">
					   <label for="tab-3">Passwort vergessen?</label>
				    </div>-->
                </div>
                <div id="sign-up-content" class="tab-content">
                <form id="signup" action="inc/login/form-direct.php" method="post" name="signup">
				    <div class="group">
					   <label for="email" class="label">E-Mail-Adresse</label>
					   <input id="email" type="email" name="email" class="input" form="signup">
				    </div>
				    <div class="group">
					   <label for="password" class="label">Passwort</label>
					   <input id="passwordsignup" type="password" name="password" class="input" data-type="password" form="signup">
                    </div>
                    <div class="progress">
				        <div id="complexity-bar" class="progress-bar" role="progressbar"></div>
				    </div>
                    <p>
					   <h1 id="complexity" class="pull-right">Ihr Passwort ist zu <span class="complexity-value">0%</span> sicher!</h1>
					</p>
				    <div class="group">
					   <input type="submit" class="button" name="signupbtn"  value="Registrieren" form="signup">
				    </div>
                </form>
				    <div class="hr"></div>
				    <div class="footer">
                        <label for="tab-1">Bereits registriert?</label>
				    </div>
                </div>
                <div id="forgot-password-content" class="tab-content">
                <form id="pw" action="inc/login/form-direct.php" method="post" name="pw">
                </form>
				    <div class="group">
					   <label for="email" class="label">E-Mail-Adresse</label>
					   <input id="email" name="email" type="email" class="input">
				    </div>
				    <div class="group">
					   <input type="submit" name="pwbtn" class="button" value="Passwort zurücksetzen">
				    </div>

                </div>

            </div>
        </div>
    </div>

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="inc/clock.js" type="application/javascript"></script>
<script src="inc/localstorage.js" type="application/javascript"></script>
<script src="inc/login/hidepw.js"></script>
<script>
    $('#passwordlogin').hidePassword(true);
    $('#passwordsignup').hidePassword(true);
</script>
<script type="text/javascript" src="inc/login/jquery.complexify.js"></script>
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
