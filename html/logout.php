<?php
session_start();
session_unset();
session_destroy();

echo "<script type='text/javascript'>alert('You have logged out successfully!'); window.location.href = 'login.php';</script>";

 ?>
