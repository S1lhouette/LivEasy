<?php
session_start();
$error ='';
//if ( isset ( $_SESSION ['user '])) {
  //    header (" location : content .php ");
//} else {
    if ( isset ($_POST ['submit'])) {

          include('connect.php');
          echo "logging in";
          $pdo=new PDO($dsn,$db_username,$db_password,$opt);
          $stmt=$pdo->query("select * from usertable where userName=\"{$_POST['username']}\" and password=\"{$_POST['password']}\"");
          $row=$stmt->fetch(PDO::FETCH_BOTH);
          if(!empty($row[0])){//loging successfully
            //echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';
            header ("location:tenantIndex.html");
     //echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
            //exit;
          //  echo"Logedin";
          }else{
            $error = " Username or Password is invalid . Try Again ";
            echo $error;
            //$pdo=NULL;
          }

//header (" location : signUp.php "); // Redirecting to Content

      //  }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../js/login.js"></script>
    <link  rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body id="background" >
<img id="logo" src="../images/logo.png" alt="logo">
<form id="form" action="login.php" method="post">
    <p id="username">Username
        <input id="usernameInput" type="text" name="username"  >
    </p>
    <p id="password">Password
        <input id="passwordInput" type="password" name="password" >
    </p>
    <input type="submit" id="loginBtn" onclick="checkNull()" value="Log in" name="submit">
    <a href="./signUp.php"><input type="button" id="signInBtn" name="Sign in" value="Sign in">Sign in</a>
</form>

</body>
</html>

