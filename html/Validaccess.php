<?php
session_start ();
if (! isset ( $_SESSION ['user'])) {
// User is not logged in , redirecting to login page
header ('Location:login.php ');
}

 ?>
