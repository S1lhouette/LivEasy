<?php
session_start ();
if (! isset ( $_SESSION ['user'])) {
// User is not logged in , redirecting to login page
header ('Location:login.php ');
}else if($_SESSION['activated']==0){
  echo "<span id='phpHint'>Please wait for your landlord activating your account</span>";
}

 ?>
