<?php
include_once('config.php');

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
    <link href="styles/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/intern.css">
    <link href="styles/fileinput.css" media="all" rel="stylesheet" type="text/css" />

    <!-- Icon -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png" />
    <link rel="icon" href="images/logo.png" type="image/png" />
    <link rel="apple-touch-icon-precomposed" href="images/icon.png" type="image/png" />

    <!-- Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/weather-icons/css/weather-icons.min.css" rel=stylesheet />

</head>

    <body>
        <!-- Header -->
        <div id="head"></div>
        <!-- Navi -->

        <nav class="navbar navbar-custom">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo" /></a>
                    <p class="navbar-brand">bottlePOST[ ]</p>
                </div>

                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Profil Content -->

        <div class="container">
            <div class="col-lg-12">
                <div class="col-lg-5 widget col-lg-offset-3">
                    <div class="inner">
            <div class="[ panel panel-default ] panel-google-plus">
               <div class="panel-heading" style="text-align: center;">
                    <h3>
                        <?php echo $this->_['meldung'];?>
                    </h3>
                   <h5>Es ist ein Fehler aufgetreten.</h5>

                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
        </div>
            </div>
        </div>
