<?php
session_start();
session_destroy();
setcookie('user', '');
setcookie('dept','');
setcookie('uname', '');
header('location:index.php');
?>


