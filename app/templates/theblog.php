<?php
include_once('../inc/functions.php');
include_once('../inc/login/config.php');
include "header.php";
if(login_check($mysqli) == true) {
?>
<h1><?php echo $this->_['blog_title']; ?></h1>
<?php echo $this->_['blog_content']; }?>
<hr />
<?php echo $this->_['blog_footer']; ?>
<?php
include "footer.php";
?>
