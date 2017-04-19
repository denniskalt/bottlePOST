<?php
session_start();
include_once('../../config.php');
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
    <link href="../../styles/login.css" rel="stylesheet" />

    <!-- Icon -->
    <link rel="shortcut icon" href="../../images/logo.png" type="image/png" />
    <link rel="icon" href="../../images/logo.png" type="image/png" />
    <link rel="apple-touch-icon-precomposed" href="../../images/icon.png" type="image/png" />

    <!-- Fonts -->
    <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body style="background-image: url(../../images/bg/way.jpg);" onload="window.setInterval('updateTime()',100)">
    <div class="container-fluid">
        <div class="row-fluid" id="login-container">
            <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 tab-head">
                <div class="cardheader">
                    <div id="time"></div>
                </div>
            </div>
        </div>
    </div>
    <?php if(!isset($_GET["acbtn"])) { ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div id="tab-wrapper" class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 card show">
                <div id="sign-in-content" class="tab-content">
                <form id="login" action="activation-link.php" method="get" name="login">
                </form>
                    <div class="group">
                        <label for="email" class="label">E-Mail-Adresse</label>
                        <input id="email" name="email" type="email" class="input" form="login">
                    </div>
				    <div class="group">
                        <input type="submit" class="button" name="acbtn" value="Aktivierungscode anfordern" form="login">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } else { ?>
        <div class="container-fluid">
        <div class="row-fluid">
            <div id="tab-wrapper" class="col-lg-4 col-sm-6 col-md-6 col-xs-12 col-lg-offset-1 col-sm-offset-2 col-md-offset-1 card">
                <div class="info">
                    <?php
                        list ($usersid, $confirmcode) = getConfirmCode($_GET["email"], $mysqli);
                    ?>
                    <div id="title-name" class="title" style="text-transform: uppercase;"><?php echo $confirmcode ?></div>
                    <div id="desc-firmname" class="desc">Aktivierungscode<br/><small style="text-decoration: underline;">Der Aktivierungscode sowie der Link (Button) würde normalerweise in der E-Mail angezeigt werden.</small></div>
                    <a class="button activation-link" href="activate.php?email=<?php echo $_GET["email"]; ?>&activate=<?php echo $confirmcode; ?>">Aktivieren</a>
                </div>
            </div>
        </div>
    </div>




<?php } ?>
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="../clock.js" type="application/javascript"></script>
</body>
</html>
