<?php
include_once('inc/functions.php');
include_once('inc/login/functions.php');
include_once('inc/login/config.php');
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}else
if($status == PHP_SESSION_DISABLED){
    //Sessions are not available
}
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
    $user = $_COOKIE["user"];
    $pointpos = strrpos ($user , '.');
    $substremail = substr ($user , 0, $pointpos );
    $data = json_decode($_COOKIE[$substremail], true);

    $email = $data["email"];
    $profilepic = $data["profilepic"];
    $username = $data["username"];
    $vorname = $data["vorname"];
    $nachname = $data["nachname"];
?>
    <body style="background-image: url(images/bg/<?php echo "way.jpg" ?>);">
<?php if(login_check($mysqli) == true) { ?>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
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
                    <div id="desc-firmname" class="desc">Welcome</div>
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
				    <div class="group">
                        <input type="submit" class="button" name="loginbtn" value="Login" form="login">
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
					   <input id="email" type="email" name="email" class="input" form="signup">
				    </div>
				    <div class="group">
					   <label for="password" class="label">Passwort</label>
					   <input id="passwordsignup" type="password" name="password" class="input" data-type="password" form="signup">
                    </div>
                    <div class="progress">
				        <div id="complexity-bar" class="progress-bar" role="progressbar"><h1 id="complexity" class="pull-right">Ihr Passwort ist zu <span class="complexity-value">0%</span> sicher!</h1></div>
				    </div>
                    <p>

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
<?php } else { ?>
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
                    <div id="desc-firmname" class="desc">Bitte <a href="index.php">loggen</a> Sie sich ein.</small></div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="inc/localstorage.js" type="application/javascript"></script>
<script type="text/javascript">
    saveLocalStorage('<?php echo $email ?>', '<?php echo $profilepic ?>', '<?php echo $username ?>', '<?php echo $vorname ?>', '<?php echo $nachname ?>');
</script>
</body>
</html>
