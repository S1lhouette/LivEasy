<?php
session_start ();
if (! isset ( $_SESSION ['user'])) {
// User is not logged in , redirecting to login page
header ('Location:login.php ');
}else if($_SESSION['userID']!=1){
  header('Location:login.php');//这里最好加上提示
}

 ?>
