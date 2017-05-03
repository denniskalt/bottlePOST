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
    <title>Post <?php echo $_GET['id']; ?></title>

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
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile" src="images/<?php echo $this->_['users'][0]->profilepic; ?>" /> <?php echo $this->_['users'][0]->forename.' '.$this->_['users'][0]->surname;?> <!--<span class="caret"></span>--></a>
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
    <!--<pre><?php print_r($this->_['posts']); ?></pre>-->
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
    <!--<div class="row">
        <div class="col-lg-8 widget col-lg-offset-2 widget widget-hashtag">
            <div class="inner">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover full">
                            <img src="images/bg/way.jpg" />
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>-->
    <div class="row">
        <div class="col-lg-8 widget col-lg-offset-2">
        <div class="inner">
            <div class="[ panel panel-default ] panel-google-plus">
                <?php if(isset($this->_['posts']['hashtags'])) { ?>
                <div class="panel-google-plus-tags">
                    <ul>
                        <?php
                            for($j=0; $j<count($this->_['posts']['hashtags']); $j++) {
                                echo '<li><a href="index.php?view=hashtag&id='.$this->_['posts']['hashtags'][$j]['hashtagid'].'">~'.$this->_['posts']['hashtags'][$j]['description'].'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
                <?php
                    }
                ?>
                <div class="panel-heading">
                    <img class="circle pull-left" src="images/<?php echo $this->_['posts']['profilepic'];?>" alt="" />
                    <h3>
                        <a href="index.php?view=profile&id=<?php echo $this->_['posts']['usersid'];?>">
                            <?php echo $this->_['posts']['forename'].' '.$this->_['posts']['surname']; ?>
                        </a>
                    </h3>
                    <h5><span><?php echo $this->_['posts']['date'];?></span> </h5>
                </div>
                <div class="panel-body">
                    <p><?php echo $this->_['posts']['content']; ?></p>
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
                    <!--<span class="dislikes">0</span>
                </div>
                <div class="panel-footer">
                    <button type="button" class="[ btn btn-default ]">+1</button>
                    <button type="button" class="[ btn btn-default ]">-1</button>-->
                    <div class="input-placeholder long">Kommentiere...</div>
                </div>
                <div class="panel-google-plus-comment">
                    <img class="img-circle" src="images/<?php echo $this->_['users'][0]->profilepic; ?>" alt="" />
                    <div class="panel-google-plus-textarea">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?view=post&id=<?php echo $_GET['id'];?>" name="comment" id="comment">
                            <textarea rows="3" class="form-control" name="comment_cont" form="comment" maxlength="160"></textarea>
                            <button type="submit" class="btn btn-info disabled" name="submit_comment" form="comment">Kommentar abschicken</button>
                            <button type="reset" class="btn btn-default" form="comment">Schließen</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        </div>

        <?php
        if(empty($this->_['posts']['comments'])) {} else {
        for($k=0; $k<count($this->_['posts']['comments']); $k++) {?>

        <div class="col-lg-6 widget col-lg-offset-3 col-xs-10 col-xs-offset-1">
            <div class="inner">
                <div class="[ panel panel-default ] panel-google-plus">
                    <div class="panel-heading">
                        <img class="circle pull-left" src="images/<?php echo $this->_['posts']['comments'][$k]['user']['profilepic'];?>" alt="" />
                        <h3>
                            <a href="index.php?view=profile&id=<?php echo $this->_['posts']['usersid'];?>">
                                <?php echo $this->_['posts']['comments'][$k]['user']['forename'].' '.$this->_['posts']['comments'][$k]['user']['surname']; ?>
                            </a>
                        </h3>
                        <h5><span><?php echo $this->_['posts']['comments'][$k]['comment_time'];?></span> </h5>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $this->_['posts']['comments'][$k]['comment']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php } }?>
    </div>
</div>
<div class="clear"></div>













