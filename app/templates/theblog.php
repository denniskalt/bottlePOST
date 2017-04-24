<?php
include_once('inc/app-functions.php');
include_once('../app/config.php');
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
include "header.php";
if(login_check($mysqli) == true) {
?>
<h1></h1>
<?php echo $this->_['blog_content']; } ?>
<hr />
<?php echo $this->_['blog_footer']; ?>
<?php
include "footer.php";
?>
