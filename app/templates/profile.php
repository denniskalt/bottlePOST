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
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu" id="contactlist">
                                <li class="heading">Kontaktsuche</li>
                                <?php
                                    if(isset($this->_['contacts'])) {
                                        $i=0;
                                        while($i<count($this->_['contacts'])) {
                                            echo "<li>";
                                            echo "<a href='index.php?view=profile&id=".$this->_['contacts'][$i]->id."'>";
                                            echo '<div class="list-topic">';
                                            if($this->_['contacts'][$i]->id == $_SESSION['usersid']) {
                                                echo '<i class="fa fa-id-card-o" aria-hidden="true"></i></div>';
                                                echo '<div class="list-item">Du</div>';
                                            } else {
                                                echo '<i class="fa fa-user" aria-hidden="true"></i></div>';
                                                echo '<div class="list-item">'. $this->_['contacts'][$i]->username .'</div>';
                                            }
                                            echo "</a></li>";
                                            $i++;
                                        }
                                    }
                                ?>
                            </ul>
                        </li>
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile" src="<?php echo $this->_['profil']; ?>" /> <?php if(!empty($this->_['vorname']) && !empty($this->_['nachname'])) { echo $this->_['vorname'].' '.$this->_['nachname']; } else { echo $this->_['username']; }?> <!--<span class="caret"></span>--></a>
                            <ul class="dropdown-menu small">
                                <li class="heading">Account</li>
                                <li>
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_SESSION['usersid'];?>">
                                        <div class="list-topic"><i class="fa fa-user" aria-hidden="true"></i></div>
                                        <div class="list-item">Mein Profil</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#configModal">
                                        <div class="list-topic"><i class="fa fa-cogs" aria-hidden="true"></i></div>
                                        <div class="list-item">Einstellungen</div>
                                    </a>
                                </li>
                                <li class="heading">Über <span class="lowercase">bottle</span>POST[ ]</li>
                                <li>
                                    <a href="inc/about/aboutus.php" target="Über uns" onClick="javascript:open('', 'Über uns', 'height=400,width=400,resizable=no')">
                                        <div class="list-topic"><i class="fa fa-users" aria-hidden="true"></i></div>
                                        <div class="list-item">Wer sind wir?</div>
                                    </a>
                                </li>
                                <li>
                                     <a href="inc/about/impressum.php" target="Impressum" onClick="javascript:open('', 'Impressum', 'height=400,width=400,resizable=no')">
                                        <div class="list-topic"><i class="fa fa-registered" aria-hidden="true"></i></div>
                                        <div class="list-item">Impressum</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="inc/about/datasecurity.php" target="Datenschutz" onClick="javascript:open('', 'Datenschutz', 'height=400,width=400,resizable=no')">
                                        <div class="list-topic"><i class="fa fa-registered" aria-hidden="true"></i></div>
                                        <div class="list-item">Datenschutz</div>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="highlight">
                                    <a href="logout.php">
                                        <div class="list-topic"><i class="fa fa-power-off" aria-hidden="true"></i></div>
                                        <div class="list-item">Ausloggen</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Profil Content -->

        <div class="container target">
            <div class="row">
                <div class="col-sm-10">
                    <?php
                        echo '<h1 class="" style="color: white;">';
                        echo $this->_['foreignname'];
                    echo '</h1><h4><kbd class="contactname">@';
                    echo $this->_['foreignusername'];
                    echo '</kbd></h4>';
                    if($_GET['id'] != $_SESSION['usersid']) {
                        if(!empty($this->_['foreignfriendship'])) {
                            echo '<a href="index.php?view=profile&id=' . $_GET['id'] . '&disfollow='. $_GET['id'].'">';
                            echo '<button type="button" class="btn btn-success">Entfolgen</button></a>';
                        } else {
                            echo '<a href="index.php?view=profile&id=' . $_GET['id'] . '&follow='. $_GET['id'].'">';
                            echo '<button type="button" class="btn btn-success">Folgen</button></a>';
                        }
                    echo '<button data-toggle="modal" data-target="#messengerModal" type="button" class="btn btn-info">Nachricht senden</button>
                    <br>';
                    }
                    if($_GET['id'] = $_SESSION['usersid']) {
                        if(!empty($this->_['foreignfriendship'])) {
                            echo '<a href="index.php?view=profile&id=' . $_GET['id'] . '&disfollow='. $_GET['id'].'">';
                            echo '<button type="button" class="btn btn-success">Entfolgen</button></a>';
                        } else {
                            echo '<a href="index.php?view=profile&id=' . $_GET['id'] . '&follow='. $_GET['id'].'">';
                            echo '<button type="button" class="btn btn-success">Folgen</button></a>';
                        }
                    echo '<button data-toggle="modal" data-target="#messengerModal" type="button" class="btn btn-info">Nachricht senden</button>
                    <br>';
                    }?>
                </div>
                <div class="col-sm-2">
                    <?php
                        if($_GET['id'] == $_SESSION['usersid']) {
                            echo '<a href="#" data-toggle="modal" data-target="#myModal" class="pull-right">';
                        }
                            echo '<img title="profile image" class="img-circle img-responsive changeImage" src= "' . $this->_['foreignprofil'] .'">';
                            echo '</a></div>';
                    ?>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <!--left col-->
                        <ul class="list-group">
                            <li class="list-group-item text-muted" contenteditable="false">Profil</li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Vorname</strong></span>
                                <?php echo $this->_['foreignvorname']; ?>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Nachname</strong></span>
                                <?php echo $this->_['foreignnachname']; ?>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Geburtsdatum</strong></span>
                            <?php echo date('d.m.Y',strtotime($this->_['foreigngeburtstag']));?>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Beigetreten am</strong></span>
                                <?php echo date('d.m.Y',strtotime($this->_['foreignerstelltam'])); ?>
                            </li>
                        </ul>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $this->_['foreignvorname']; if(substr($this->_['foreignvorname'], -1) != "s") { echo "'s"; } ?> Motto</div>
                            <div class="panel-body"><i style="color:green" class="fa fa-check-square"></i>
                                <?php echo $this->_['motto']; ?>
                            </div>
                        </div>

                        <ul class="list-group">
                            <li class="list-group-item text-muted">Aktivitäten <i class="fa fa-dashboard fa-1x"></i></li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Kommentare</strong></span>
                                <?php echo $this->_['comments']; ?>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Likes</strong></span>
                                <?php echo $this->_['likes']; ?>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Posts</strong></span>
                                <?php echo $this->_['postings']; ?>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Followers</strong></span>
                                <?php echo $this->_['followers']; ?>
                            </li>
                        </ul>

                    </div>
                    <!--/col-3-->
                    <div class="col-sm-6" style="" contenteditable="false">
                        <div class="col-lg-12 widget col-lg-offset-0">


                            <?php

                if($_GET['id'] == $_SESSION['usersid']) {
                    echo '
            <div class="inner">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="images/bg/way.jpg" />
                        </div>
                        <div class="user">';
                            echo '<img class="img-circle" src= "' . $this->_['profil'] .'">';
                    echo    '</div>
                        <div class="content">
                            <div class="main">
                                <form method="post" action="'.$_SERVER['PHP_SELF'].'?view=profile&id=' .$_SESSION['usersid'].'">
                                    <textarea class="form-control" rows="3" id="posting" name="posting" maxlength="160"></textarea>
                                    <span id="count_message" class="characters-remaining">160 Zeichen verbleibend</span>
                                    <input hidden="hidden" value="'.$this->_["users"][0]->id.'" name="usersid" />
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
        ';

                }

            ?>
                        </div>

                        <?php if(isset($this->_['posts'])) { ?>

                        <?php $i=0; while($i<count($this->_['posts'])) { ?>
                        <div class="col-lg-12 widget col-lg-offset-0">
                              <?php if($_GET['id'] == $_SESSION['usersid']) {

                    echo '<a href="'.$_SERVER["PHP_SELF"].'?view=profile&id='.$_GET["id"].'&del='.$this->_["posts"][$i]["postid"].'" class="close" aria-label="close">&times;</a>';

                                                }
                                            ?>
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
                                                <img class="circle pull-left" src="<?php echo $this->_['posts'][$i]['profilepic'];?>" alt="" />
                                            <h3>
                                                <a href="index.php?view=profile&id=<?php echo $this->_['posts'][$i]['usersid'];?>">
                                                    <?php echo $this->_['posts'][$i]['forename'].' '.$this->_['posts'][$i]['surname']; ?>
                                                </a>
                                            </h3>
                                            <h5><span><?php echo $this->_['posts'][$i]['date'];?></span> </h5>
                                        </div>
                                        <div class="panel-body">
                                            <p>
                                                <?php echo $this->_['posts'][$i]['content']; ?>
                                            </p>
                                        </div>
                                        <div id="rating" class="panel-footer">
                                           <a href="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_GET['id'];?>&liked=<?php echo $this->_['posts'][$i]['postid'];?>"> <button class="like btn btn-default
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
                        ?>" type="button">+1</button></a>
                                            <!--<span class="likes">0</span>-->
                                           <a href="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_GET['id'];?>&disliked=<?php echo $this->_['posts'][$i]['postid'];?>"> <button class="dislike btn btn-default
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
                                               ?>" type="button">-1</button></a>
                                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?view=post&id=<?php echo $this->_['posts'][$i]['postid'];?>">
                                                <button class="btn btn-default" type="submit">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                            </button>
                                            </a>

                                            <div class="input-placeholder">Kommentiere...</div>
                                        </div>
                                        <div class="panel-google-plus-comment">
                                            <img class="img-circle" src="images/<?php echo $this->_['users'][0]->profilepic; ?>" alt="" />
                                            <div class="panel-google-plus-textarea">
                                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?view=post&id=<?php echo $this->_['posts'][$i]['postid'];?>">
                                                    <textarea rows="3" class="form-control" name="comment_cont" maxlength="160"></textarea>
                                                    <button type="submit" class="btn btn-info disabled" name="submit_comment">Kommentar abschicken</button>
                                                    <button type="reset" class="btn btn-default">Schließen</button>
                                                </form>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; } } else {
                            echo  '<div class="col-lg-12 widget col-lg-offset-0">
                            <div class="inner">
                                <div class="[ panel panel-default ] panel-google-plus">';
                            echo $this->_['foreignvorname'] . ' hat leider noch nichts gepostet :(';
                            echo  '</div></div></div>';
                        } ?>
                    </div>

                    <div class="col-sm-3">
                        <div class="panel panel-default target">
                            <div class="panel-heading" contenteditable="false">
                                <?php echo $this->_['foreignvorname']; if(substr($this->_['foreignvorname'], -1) != "s") { echo "'s"; } ?> Fotos</div>
                            <div class="panel-body" style="margin: 0;">
                                <div class="row" style="margin: 0;">
                                    <?php
                                        if(isset($this->_['uploads'])) {
                                      $i=0;
                                      while($i<count($this->_['uploads'])) {

                                           echo "<div class='col-m-6'><a title='" . $this->_['uploads'][$i]['title'] . "' href='#'><img class='thumbnail img-responsive' src='" . $this->_['uploads'][$i]['src'] . "'></a></div>";

                                          $i++;

                                      }

                                        }


                                    ?>

                                </div>
                                <?php
                        if($_GET['id'] == $_SESSION['usersid']) {
                            echo "<a href='#' data-toggle='modal' data-target='#imageModal'><div class='btn btn-primary' style='width: 100%; margin-top: 5px; margin-bottom: -5px;'>Bild hochladen</div></a>";
                        }
                    ?>
                            </div>

                            <div id="push"></div>
                        </div>

                    </div>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header borderBlock">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Profilbild wählen</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Bitte wählen Sie Sich ein Profilbild aus oder laden Sie ein Bild hoch.</p>

                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_SESSION['usersid'];?>" method="post" enctype="multipart/form-data">

                                        <label class="radio-inline"><center><img class="changeImage" src="images/default/profile-placeholder.jpg" class="radioImage"><p></p><input type="radio" name="optradio" value="Standardbild 1" <?php  if($this->_['imageIndex'] == 0) echo"checked"; ?>>Standardbild 1</center></label>
                                        <label class="radio-inline"><center><img class="changeImage" src="images/default/profile-placeholder_female.jpg" class="radioImage"><p></p><input type="radio" name="optradio" value="Standardbild 2" <?php  if($this->_['imageIndex'] == 1) echo"checked"; ?>>Standardbild 2</center></label>
                                        <label class="radio-inline"><center><img src="<?php if($this->_['imageIndex'] == 2) { echo $this->_['profil']; } else { echo 'images/default/profile-placeholder.jpg';} ?>" class="radioImage changeImageUpload"><p></p><input type="radio" name="optradio" value="Standardbild 3" <?php  if($this->_['imageIndex'] == 2) echo"checked"; ?>>Eigenes Bild</center></label>

                                        <p></p>

                                        <hr>
                                        <div class="form-group">
                                            <input id="file-0d" data-show-preview="false" class="file" name="url" type="file">
                                        </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="submit_profilimage">Speichern</button>
                                    </form>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal (Messenger) -->
            <div id="messengerModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header borderBlock">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nachricht senden</h4>
                        </div>
                        <div class="modal-body">

                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="usr">Name:</label>
                                    <input type="text" class="form-control" id="usr">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Nachricht:</label>
                                    <textarea class="form-control" rows="5" id="comment"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Senden</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal (Image-Upload) -->

            <div tabindex="-1" class="modal fade" id="imageModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal">×</button>
                            <h3 class="modal-title">Bilder hochladen</h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                <blogquote>Bitte wählen Sie hier Ihre Bilder aus, die Sie hochladen möchten.</blogquote>
                            </p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_SESSION['usersid'];?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Bildtitel" required>
                                </div>
                                <div class="form-group">
                                    <input id="file-0d" data-show-preview="false" class="file" name="url" type="file" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal (Image Gallery) -->

            <div tabindex="-1" class="modal fade" id="imgModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal">×</button>
                            <h3 id="IMGtitle" class="modal-title"></h3>
                        </div>
                        <div id="IMGbody" class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <form id="form_deleteIMG" action="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_SESSION['usersid'];?>" method="POST">
                                <input type="text" id="hiddenID" name="imgID" hidden="true">
                                <button type="submit" name="deleteIMG" class="btn btn-danger">Löschen</button>
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

          <!-- Modal (Konfiguration) -->

            <div tabindex="-1" class="modal fade" id="configModal" role="dialog">
               <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #3884cf; color: white;">
                            <button class="close" type="button" data-dismiss="modal">×</button>
                            <h3 class="modal-title">Profileinstellungen ändern</h3>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?view=profile&id=<?php echo $_SESSION['usersid'];?>&edit=1" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="benutzername">Benutzername</label>
                                    <input type="text" class="form-control" name="benutzername" placeholder="Benutzername" value="<?php echo $this->_['username']; ?>" required>
                                </div>
                                 <div class="form-group">
                                     <label for="vorname">Vorname</label>
                                    <input type="text" class="form-control" name="vorname" placeholder="Vorname" value="<?php echo $this->_['vorname']; ?>"required>
                                </div>
                                 <div class="form-group">
                                    <label for="nachname">Nachname</label>
                                    <input type="text" class="form-control" name="nachname" placeholder="Nachname" value="<?php echo $this->_['nachname']; ?>" required>
                                </div>
                                 <div class="form-group">
                                     <label for="email">E-Mail Adresse</label>
                                    <input type="email" class="form-control" name="email" placeholder="E-Mail Adresse" value="<?php echo $this->_['email']; ?>" required>
                                </div>
                                 <div class="form-group">
                                     <label for="geburtsdatum">Geburtsdatum</label>
                                    <input type="date" class="form-control" name="geburtsdatum"  placeholder="Geburtsdatum" value="<?php echo $this->_['geburtstag']; ?>" required>
                                </div>
                                 <div class="form-group">
                                     <label for="motto">Motto</label>
                                    <input type="text" class="form-control" name="motto" placeholder="Motto" value="<?php echo $this->_['motto']; ?>" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Speichern</button>
                            </form>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
