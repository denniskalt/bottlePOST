<?php
include_once('inc/app-functions.php');
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

    <!-- Icon -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png" />
    <link rel="icon" href="images/logo.png" type="image/png" />
    <link rel="apple-touch-icon-precomposed" href="images/icon.png" type="image/png" />

    <!-- Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
</head>
<?php
    /*$user = $_COOKIE["user"];
    $pointpos = strrpos ($user , '.');
    $substremail = substr ($user , 0, $pointpos );
    $data = json_decode($_COOKIE[$substremail], true);

    $email = $data["email"];
    $profilepic = $data["profilepic"];
    $username = $data["username"];
    $vorname = $data["vorname"];
    $nachname = $data["nachname"];*/
?>
<body style="background-image: url(images/bg/way.jpg);">
<?php if(login_check($mysqli) == true) { ?>
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
            <a class="navbar-brand" href="index.php"><img src="https://upload.wikimedia.org/wikipedia/de/thumb/9/9f/Twitter_bird_logo_2012.svg/1200px-Twitter_bird_logo_2012.svg.png" alt="logo" /></a>
            <p class="navbar-brand">bottlePOST[ ]</p>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <!--<ul class="nav navbar-nav">
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
          </ul>-->
          <!--<form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
          </form>-->
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i></a></li>

            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Anfragen <span class="caret"></span></a>
              <ul class="dropdown-menu notification wide">
                <li class="heading">Freundschaftsanfragen</li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt</h4>
                                <p class="item-info">4 gemeinsame Follower</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-2.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Lukas Bosse mag deinen Post.</h4>
                                <p class="item-info">vor 7 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-1.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Maren Bassmann mag deinen Post.</h4>
                                <p class="item-info">vor 8 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-2.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Lukas Bosse folgt dir nun. Schaue dir sein Profil an.</h4>
                                <p class="item-info">18.03.2017</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
              </ul>
            </li>-->
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nachrichten <span class="caret"></span></a>
              <ul class="dropdown-menu notification wide">
                <li class="heading">Nachrichten</li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt</h4>
                                <p class="item-subtitle">"Hallo User X, kenne ich Dich von irgendwoher? ..."</p>
                                <p class="item-info">vor 4 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt</h4>
                                <p class="item-subtitle">"Hallo User X, kenne ich Dich von irgendwoher? ..."</p>
                                <p class="item-info">vor 4 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt</h4>
                                <p class="item-subtitle">"Hallo User X, kenne ich Dich von irgendwoher? ..."</p>
                                <p class="item-info">vor 4 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt</h4>
                                <p class="item-subtitle">"Hallo User X, kenne ich Dich von irgendwoher? ..."</p>
                                <p class="item-info">vor 4 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
              </ul>
            </li>-->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick="loadContent();">
                  <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                  <i class="fa fa-bell" aria-hidden="true"></i>
                </a>
              <ul class="dropdown-menu wide notification" id="myContent">
                <li class="heading">Benachrichtigungen</li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-0.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Dennis Kalt hat deinen Post kommentiert.</h4>
                                <p class="item-subtitle">"Das ist mein erster Kommentar zu einem Post!"</p>
                                <p class="item-info">vor 4 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-2.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Lukas Bosse mag deinen Post.</h4>
                                <p class="item-info">vor 7 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-1.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Maren Bassmann mag deinen Post.</h4>
                                <p class="item-info">vor 8 Stunden</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="notification-wrapper">
                        <a class="content" href="#">
                            <div class="notification-image">
                                <img src="images/user/default-2.jpg" />
                            </div>
                            <div class="notification-item">
                                <h4 class="item-title">Lukas Bosse folgt dir nun. Schaue dir sein Profil an.</h4>
                                <p class="item-info">18.03.2017</p>
                            </div>
                            <div class="notification-topic">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                            </div>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile" src="images/user/default-0.jpg" /> Max Mustermann <!--<span class="caret"></span>--></a>
              <ul class="dropdown-menu small">
                  <li class="heading">Account</li>
                  <li><a href="#">
                      <div class="list-topic"><i class="fa fa-user" aria-hidden="true"></i></div>
                      <div class="list-item">Mein Profil</div>
                  </a></li>
                  <li><a href="#">
                      <div class="list-topic"><i class="fa fa-cogs" aria-hidden="true"></i></div>
                      <div class="list-item">Einstellungen</div>
                  </a></li>
                  <li class="heading">Über <span class="lowercase">bottle</span>POST[ ]</li>
                  <li><a href="#">
                      <div class="list-topic"><i class="fa fa-users" aria-hidden="true"></i></div>
                      <div class="list-item">Wer sind wir?</div>
                  </a></li>
                  <li><a href="#">
                      <div class="list-topic"><i class="fa fa-commenting" aria-hidden="true"></i></div>
                      <div class="list-item">Kontakt</div>
                  </a></li>
                  <li><a href="#">
                      <div class="list-topic"><i class="fa fa-registered" aria-hidden="true"></i></div>
                      <div class="list-item">Impressum</div>
                  </a></li>
                  <li><a href="#">
                      <div class="list-topic"><i class="fa fa-registered" aria-hidden="true"></i></div>
                      <div class="list-item">Datenschutz</div>
                  </a></li>
                  <li role="separator" class="divider"></li>
                  <li class="highlight"><a href="logout.php">
                      <div class="list-topic"><i class="fa fa-power-off" aria-hidden="true"></i></div>
                      <div class="list-item">Ausloggen</div>
                  </a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
<?php } ?>
