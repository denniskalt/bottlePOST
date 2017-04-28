<?php
include_once('inc/app-functions.php');
include_once('../app/config.php');
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if(login_check($mysqli) == true) {
?>
<?php echo $this->_['blog_content']; } ?>
<footer>
<!--<hr />-->
<?php //echo $this->_['blog_footer']; ?>
<?php
include "footer.php";
?>
</footer>
