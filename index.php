<?php
    // Bei abgelegtem User direkt an den geschützten Bereich weiterleiten
    /*if(isset($_SESSION['user'])!="") {
        header("Location: SAFEAREA");
    }

    include_once 'inc/login/config.php';
    include_once 'inc/login/functions.php';*/
    session_start();
$value = "value";
$_SESSION["newsession"]=$value;
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
            <div class="col-lg-4 col-sm-8 col-md-5 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 tab-head">
                <div class="cardheader">
                    <div id="time"></div>
                </div>
                <div class="avatar">
                    <img alt="Profilfoto" src="images/user.jpg" class="image-circle" id="avatar">
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-lg-offset-2 col-md-offset-1 hidden-sm hidden-xs tab-head">
                <div class="cardheader">
                    <div id="time">
                        <p class="uhrzeit">Bitte nutze sichere Passwörter!</p>
                        <p class="datum">Verwende zu dieses Passwort zu deiner Sicherheit an keiner anderen Stelle.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div id="tab-wrapper" class="col-lg-4 col-sm-8 col-md-5 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 card">
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
        <a class="btn btn-default" href="inc/login/activation-link.php">Zum Aktivierungscode</a>
      </div>
    </div>

  </div>
</div>
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab"><?php if(!isset($_GET["register"])) { echo "Login"; } else { echo "Aktivierung"; } ?></label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Register</label>
                <input id="tab-3" type="radio" name="tab" class="forgot-password"><label for="tab-3" class="tab" style="display: none;">Forgot?</label>
                <div id="sign-in-content" class="tab-content">
                <form id="login" action="inc/login/form-direct.php" method="post" name="login">
                </form>
                    <?php
                        if(!isset($_GET["register"])) {
                    ?>
                    <div class="group">
                        <label for="email" class="label">E-Mail-Adresse</label>
                        <input id="email" name="email" type="email" class="input" form="login" onkeyup="loadLocalStorage();" required>
                    </div>
				    <div class="group">
                        <label for="password" class="label">Passwort</label>
                        <input id="passwordlogin" name="password" type="password" class="input" data-type="password" form="login" required>
                    </div>
				    <div class="group">
                        <input type="submit" class="button" name="loginbtn" value="Login" form="login"> <?php } else { ?>
                    <div class="group">
                        <input type="submit" class="btn btn-info btn-lg button" data-toggle="modal" data-target="#myModal" value="Aktivierung durchführen" />
                    <?php } ?>
                    </div>
				    <div class="hr"></div>
				    <div class="footer">
					   <label for="tab-3">Passwort vergessen?</label>
				    </div>
                </div>
                <div id="sign-up-content" class="tab-content">
                <form id="signup" action="inc/login/form-direct.php" method="post" name="signup">
				    <div class="group">
					   <label for="email" class="label">E-Mail-Adresse</label>
					   <input id="email" type="email" name="email" class="input" form="signup" required>
				    </div>
                    <div class="group">
					   <label for="user" class="label">Benutzername</label>
					   <input id="user" type="text" name="user" class="input" form="signup" required>
				    </div>
				    <div class="group">
					   <label for="password" class="label">Passwort</label>
					   <input id="passwordsignup" type="password" name="password" class="input" data-type="password" form="signup" required>
                    </div>
                    <div class="progress">
				        <div id="complexity-bar" class="progress-bar" role="progressbar"><h1 id="complexity" class="pull-right">Ihr Passwort ist zu <span class="complexity-value">0%</span> sicher!</h1></div>
				    </div>

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
                </form>
                <form id="pw" action="inc/login/form-direct.php" method="post" name="pw">
				    <div class="group">
					   <label for="email" class="label">E-Mail-Adresse</label>
					   <input id="email" type="email" name="email" class="input" form="pw" required>
				    </div>
				    <div class="group">
					   <input type="submit" class="button" name="pwbtn"  value="Passwort zurücksetzen" form="pw">
				    </div>
                </form>
                </div>
            </div>
        </div>
        <div id="tab-wrapper" class="col-lg-4 col-md-5 hidden-sm hidden-xs col-lg-offset-2 col-md-offset-1 card">
                <div class="info">
                    <div id="title-name" class="title">Folgende Regeln wurden für deine Sicherheit implementiert:</div>
                    <div id="desc-firmname" class="desc" style="text-align: left;"><br/>
                        - Mindestlänge: 8 Zeichen<br/>
                        - Davon mindestens 2 Ziffern oder Sonderzeichen<br/>
                        <small>Erlaubt sind: _, -, #, (, ), @, §, !</small>
                    </div>
                    <div id="title-name" class="title" style="margin-top: 40px;">So kommst du an ein sicheres Passwort, das sich leicht merken lässt:</div>
                    <div id="desc-firmname" class="desc" style="text-align: left;"><br/>
                        Bilde einen Satz und setze das Passwort aus den Anfangsbuchstaben in der jeweiligen Groß- und Kleinschreibung zusammen. <br/>
                        <small>Beispiel:<br/>"Am Sonntag stehe ich nie vor 12 Uhr auf!": ASsinv12Ua!<br/>"Morgen ist ein Feiertag - das ist aber schön!": MieF-dias!</small>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
