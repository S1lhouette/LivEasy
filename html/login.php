<?php
error_reporting(0);
session_start();


    if ( isset ($_POST ['submit'])) {
        $error="";
        $user = $_POST["email"];
        $psw = $_POST["password"];
      if(($user == "")||($psw == "")){
      }else{
        include('connect.php');
        $pdo=new PDO($dsn,$db_username,$db_password,$opt);
        $stmt=$pdo->query("select * from usertable where email=\"{$_POST['email']}\" and password=\"{$_POST['password']}\"");
        $row=$stmt->fetch(PDO::FETCH_BOTH);
        $userId=$row["userID"];
        if($userId==1){
          $_SESSION ['user']= $_POST ['email'];
          $_SESSION['userID']=$userId;
          header();
        }else{
          if(!empty($row[0])){//loging successfully
            //echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';
            $_SESSION ['user']= $user;
            $_SESSION['userID']=$userId;
            header ("location:tenantIndex.html");
     //echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
          }else{
            $error = " Email or Password is Wrong . Try Again ";
            //echo "<Label>alert(' Username or Password is invalid . Try Again');</Label>";
            //$pdo=NULL;
          }
        }
      }
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
  <table id="table">
    <tr>
    <td id="email">Email</td>
    <td><input id="emailInput" type="text" name="email"  ></td>
    </tr>
    <tr>
    <td id="password">Password</td>
    <td><input id="passwordInput" type="password" name="password" ></td>
    </tr>
  </table>
    <input type="submit" id="loginBtn" onclick="checkNull()" value="Log in" name="submit"></input>
    <a href="./signIn.php"><input type="button" id="signInBtn" name="Sign in" value="Sign in"></input>Sign in</a>

</form>
<div id = "hint">
  <?php
  if($error!=""){
  echo"<span id='phpHint'>".$error."</span>";//the size of the text here needs to be fixed
  $error="";
  }
   ?>
</div>
</body>
</html>
