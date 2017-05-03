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

    <!-- Icon -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png" />
    <link rel="icon" href="images/logo.png" type="image/png" />
    <link rel="apple-touch-icon-precomposed" href="images/icon.png" type="image/png" />

    <!-- Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/weather-icons/css/weather-icons.min.css" rel=stylesheet />
</head>
<body>
<?php
/*
// Gibt eine Instanz der Directory Klasse an $dirHandle zurück
$dirHandle = dir("../app");

// Verzeichnis Datei für Datei lesen
while (($f = $dirHandle->read()) != false) {
   // Nur ausgeben, wenn nicht . oder ..
    if ($f != "." && $f != ".."){
        // Wenn es sich um ein Verzeichnis handelt
        if (is_dir("files/".$f)){
            echo "<em>".$f."</em><br />";
        }
        else {
            echo $f."<br />";
        }
    }
}

// Verzeichnis wieder schließen
$dirHandle->close();
    */
?>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                  <i class="fa fa-bell" aria-hidden="true"></i>
                </a>
              <ul class="dropdown-menu wide notification" id="myContent">
                <li class="heading">Benachrichtigungen</li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile" src="images/<?php echo $this->_['users'][0]->profilepic; ?>" /> <?php if(!empty($this->_['users'][0]->forename) && !empty($this->_['users'][0]->surname)) { echo $this->_['users'][0]->forename.' '.$this->_['users'][0]->surname; } else { echo $this->_['users'][0]->username; }?> <!--<span class="caret"></span>--></a>
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

<div class="container-fluid wrapper">
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 widget widget-weather">
            <div class="inner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div id="card" class="weather">
                                <div class="city-selected">
                                    <article>
                                        <div class="info">
                                            <div class="city"><?php echo $this->_['user'][0]->name; ?></div>
                                            <div class="night"><?php echo $this->_['tageszeit']; ?> - <?php echo $this->_['datacalc']; ?></div>
                                            <div class="temp"><?php echo $this->_['temperature']; ?> <span class="temp">°C</span></div>
                                            <div class="wind">
                                                <svg version="1.1" id="wind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 300.492 300.492" style="enable-background:new 0 0 300.492 300.492;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path style="fill:#FFFFFF;" d="M287.166,100.421c-9.502-13.217-24.046-23.034-39.868-26.945
                                                                c-5.309-1.365-10.845-2.061-16.453-2.061c-11.531,0-22.257,3.035-30.981,8.746c-14.076,8.86-23.709,23.91-25.759,40.157
                                                                c-2.698,16.644,4.357,34.315,17.519,43.959c7.555,5.716,17.47,8.991,27.201,8.991c7.332,0,14.109-1.811,19.575-5.216
                                                                c14.936-8.991,21.495-28.577,14.626-43.665c-3.525-7.669-10.427-13.647-18.455-15.975c-2.361-0.696-4.754-1.082-7.131-1.164
                                                                l-0.288,5.434c1.974,0.141,3.916,0.544,5.782,1.202c6.288,2.143,11.536,7.093,14.044,13.288c1.256,2.975,1.893,6.211,1.822,9.355
                                                                c-0.071,3.421-0.658,6.565-1.855,9.861c-2.366,6.222-6.967,11.667-12.678,14.968c-10.269,6.233-26.624,4.329-37.171-4.172
                                                                c-10.405-8.278-15.529-21.87-13.364-35.528c1.8-13.413,9.85-25.71,21.56-32.912c5.553-3.514,12.069-5.803,18.868-6.636
                                                                c2.823-0.359,6.619-0.413,10.285-0.131c3.497,0.31,7.033,0.903,10.231,1.713c13.358,3.437,25.623,11.863,33.668,23.154
                                                                c8.365,11.324,12.325,24.96,11.438,39.477c-0.587,14.098-5.423,28.305-13.619,40.021c-8.159,11.759-19.907,21.354-33.108,27.027
                                                                c-6.059,2.654-13.07,4.574-20.832,5.695c-4.803,0.68-9.959,0.8-16.203,0.892l-176.09,2.339l-29.817,1.164l0.109,5.439
                                                                l199.015,0.131c2.295,0,4.596,0,6.88,0.022l4.253,0.027c3.835,0,8.376-0.071,12.988-0.593c8.36-1.033,16.263-3.111,23.464-6.168
                                                                c14.925-6.206,28.283-16.905,37.606-30.127c9.426-13.206,15.072-29.36,15.893-45.438
                                                                C301.476,130.293,296.679,113.399,287.166,100.421z"/>
                                                        </g>
                                                        <g>
                                                            <path style="fill:#FFFFFF;" d="M106.617,209.839c0.664-0.027,1.463-0.038,2.23-0.038l5.445,0.065
                                                                c1.528,0.027,2.959,0.049,4.395,0.049c2.801,0,6.511-0.076,10.438-0.647c7.626-1.246,14.849-4.471,20.864-9.312
                                                                c12.374-9.752,18.874-25.999,16.562-41.391c-2.371-15.648-15.953-28.697-31.547-30.35c-8.539-1.05-16.421,0.979-22.404,5.619
                                                                c-6.451,4.824-10.688,12.091-11.612,19.842c-1.229,8.077,1.806,16.589,7.664,21.637c5.803,5.287,15.431,7.43,22.387,5.037
                                                                c5.102-1.702,9.42-5.798,11.563-10.971l-4.928-2.284c-1.817,3.519-5.096,6.124-8.762,6.957c-1.218,0.277-2.317,0.408-3.367,0.408
                                                                c-4.329,0-8.762-1.866-11.591-4.89c-3.835-4.003-5.249-9.11-4.096-14.762c1.044-5.08,4.308-10.106,8.496-13.124
                                                                c4.449-3.176,9.284-4.286,15.349-3.405c11.123,1.441,20.603,10.943,22.077,22.229c1.996,11.335-2.877,24.013-12.173,31.585
                                                                c-4.585,3.867-10.193,6.494-16.236,7.604c-2.469,0.479-4.922,0.571-7.647,0.642l-104.506,2.752
                                                                C10.264,203.524,5.134,203.9,0,204.275l0.19,5.434L106.617,209.839z"/>
                                                        </g>
                                                    </g>
                                                </g>
                                                <span><?php echo $this->_['wind']; ?> km/h</span>
                                            </div>
                                        </div>
                                        <div class="icon">
                                            <i class="wi <?php echo $this->_['weather']; ?>"></i>
                                        </div>
                                    </article>
                                    <figure style="background-image: url(images/country/de.jpg);"></figure>
                                    <!--<div class="day">
                                        <p class="date">24.04.2017</p>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 widget widget-post">
            <div class="inner">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="images/bg/way.jpg" />
                        </div>
                        <div class="user">
                            <img class="img-circle" src="images/<?php echo $this->_['users'][0]->profilepic; ?>"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <textarea class="form-control" rows="3" id="posting" name="posting" maxlength="160"></textarea>
                                    <span id="count_message" class="characters-remaining">160 Zeichen verbleibend</span>
                                    <input hidden="hidden" value="<?php echo $this->_['users'][0]->id;?>" name="usersid" />
                                    <button class="btn btn-info btn-post" name="submit_post" type="submit">Status posten</button>
                                </form>
                                <div class="clear"></div>

                            </div>
                            <!--<div class="footer">
                                <a class="btn btn-simple" href="profile.php">
                                    <i class="fa fa-mail-forward"></i> Zum Profil
                                </a>
                            </div>-->
                        </div>
                        </div> <!-- end front panel -->
                    </div> <!-- end card -->
                </div> <!-- end card-container -->
            </div> <!-- end col sm 3 -->
        </div>
        <div class="col-lg-4 widget widget-stats">
            <div class="inner">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="content">
                            <div class="main">
                                <h3 class="name"><?php echo $this->_['users'][0]->forename.' '.$this->_['users'][0]->surname;?></h3>
                                <p class="profession">@<?php echo $this->_['users'][0]->username; ?></p>
                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            folgen Dir
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            folgst Du
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Muschelpoints
                                        </p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <!--<p class="text-center">"Hier werden später Erinnerungen angezeigt."</p>-->
                            </div>
                            <div class="footer">
                                <a class="btn btn-simple" href="index.php?view=profile&id=<?php echo $this->_['users'][0]->id;?>">
                                    <i class="fa fa-mail-forward"></i> Zum Profil
                                </a>
                            </div>
                        </div>
                        </div> <!-- end front panel -->
                    </div> <!-- end card -->
                </div> <!-- end card-container -->
            </div> <!-- end col sm 3 -->
        </div>
    </div>
    <div class="row">
    <?php
    if(isset($_POST['submit_post'])) {
        $content = $_POST['posting'];
        $id = $_POST['usersid'];
        $posting = new Posts();
        $posting->usersid = $id;
        $posting->content = $content;
        $postid = DAOFactory::getPostsDAO()->setPost($posting);
        // Hashtags filtern
        $hashtags = DAOFactory::getHashtagsDAO()->findHashtags($content, $str = 0);

        // Hashtags aus Post auslesen
        for($k=0; $k<count($hashtags); $k++) {
            $counter=0;
            $res = DAOFactory::getHashtagsDAO()->getHashtags();
            print_r($hashtags[$k]);
            print_r($res[$k]->description);
            // Alle Hashtags der DB durchlaufen
            for($l=0; $l<count($res); $l++) {
                if($hashtags[$k]===$res[$l]->description) {
                    //$hashpost = new HashtagsPosts();
                    //$hashpost->id = $hashtags[$k];
                    //$res = DAOFactory::getHashtagsDAO()->setHashtag($hash);
                    echo "<h2>Gefunden:</h2>";
                    // id für Hashtag-ID
                    echo "<h2>".$res[$l]->description."</h2>";
                    $hashtagsid = $res[$l]->id;
                    // Speichern von Beziehung
                    $counter--;
                }
                else {

                }
            }
            if($counter!=0) {
                // Speichern Beziehung
                $hashpost = new HashtagsPosts();
                $hashpost->hashtagsid = $hashtagsid;
                $hashpost->postsid = $postid;
                DAOFactory::getHashtagsPostsDAO()->setHashtagPosts($hashpost);
            }
            else {
                $hash = new Hashtags();
                $hash->description = $hashtags[$k];
                $hashtagid = DAOFactory::getHashtagsDAO()->setHashtag($hash);
                $hashpost = new HashtagsPosts();
                $hashpost->hashtagsid = $hashtagid;
                $hashpost->postsid = $postid;
                DAOFactory::getHashtagsPostsDAO()->setHashtagPosts($hashpost);
            }
        }
    header('Location: '.$_SERVER['PHP_SELF']);
    }

    ?>
    <?php $i=0; while($i<count($this->_['posts'])) { ?>
        <div class="col-lg-5 widget col-lg-offset-3">
        <div class="inner">
            <div class="[ panel panel-default ] panel-google-plus">
                <?php if(isset($this->_['posts'][$i]['hashtags'])) { ?>
                <div class="panel-google-plus-tags">
                    <ul>
                        <?php
                            for($j=0; $j<count($this->_['posts'][$i]['hashtags']); $j++) {
                                echo '<li><a href="index.php?view=hashtag&id='.$this->_['posts'][$i]['hashtags'][$j]['hashtagid'].'">~'.$this->_['posts'][$i]['hashtags'][$j]['description'].'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
                <?php
                    }
                ?>
                <div class="panel-heading">
                    <img class="circle pull-left" src="images/<?php echo $this->_['posts'][$i]['profilepic'];?>" alt="" />
                    <h3>
                        <a href="index.php?view=profile&id=<?php echo $this->_['posts'][$i]['usersid'];?>">
                            <?php echo $this->_['posts'][$i]['forename'].' '.$this->_['posts'][$i]['surname']; ?>
                        </a>
                    </h3>
                    <h5><span><?php echo $this->_['posts'][$i]['date'];?></span> </h5>
                </div>
                <div class="panel-body">
                    <p><?php echo $this->_['posts'][$i]['content']; ?></p>
                </div>
                <div id="rating" class="panel-footer">
                    <button class="like btn btn-default
                        <?php
                            if(empty($this->_['posts'][$i]['votes'])) {
                            }
                            else {
                                if($this->_['posts'][$i]['votes']==1) {
                                    echo 'disabled';
                                }
                            }
                            echo '" id="';
                            echo $this->_['posts'][$i]['postid'];
                        ?>" type="button">+1</button>
                    <!--<span class="likes">0</span>-->
                    <button class="dislike btn btn-default
                        <?php
                            if(empty($this->_['posts'][$i]['votes'])) {
                            }
                            else {
                                if($this->_['posts'][$i]['votes']==-1) {
                                    echo 'disabled';
                                }
                            }
                            echo '" id="';
                            echo $this->_['posts'][$i]['postid'];
                        ?>" type="button">-1</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?view=post&id=<?php echo $this->_['posts'][$i]['postid'];?>">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                            </button>
                        </a>
                    <!--<span class="dislikes">0</span>
                </div>
                <div class="panel-footer">
                    <button type="button" class="[ btn btn-default ]">+1</button>
                    <button type="button" class="[ btn btn-default ]">-1</button>-->
                    <div class="input-placeholder">Kommentiere...</div>
                </div>
                <div class="panel-google-plus-comment">
                    <img class="img-circle" src="images/<?php echo $this->_['users'][0]->profilepic; ?>" alt="" />
                    <div class="panel-google-plus-textarea">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?view=post&id=<?php echo $this->_['posts'][$i]['postid'];?>">
                            <textarea rows="3" class="form-control" name="comment_cont" maxlength="160"></textarea>
                            <button type="submit" class="btn btn-info disabled" name="submit_comment" >Kommentar abschicken</button>
                            <button type="reset" class="btn btn-default" >Schließen</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        </div>
    <?php $i++; } ?>

    </div>
</div>
<div class="clear"></div>













