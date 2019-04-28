<?php
error_reporting(0);
session_start();
include('connect.php');


    if ( isset ($_POST ['submit'])) {
        $error="";
        $user = $_POST["email"];
        $psw = $_POST["password"];
        if(($user == "")||($psw == "")){

        }else{

          $pdo=new PDO($dsn,$db_username,$db_password,$opt);
          $hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
          $stmt=$pdo->query("select * from usertable where email=\"{$_POST['email']}\"");
          $row=$stmt->fetch(PDO::FETCH_BOTH);
          if(password_verify($_POST['password'],$row['password'])){//loging successfully
            if($row['activated']==0){
              echo "<script type='text/javascript'>alert('Sorry, your account has not been activated yet. Please wait for the activation of the landlord.'); window.location.href = 'login.php';</script>";
            }else if($row['userID']==1){
              $_SESSION ['user']= $user;
              $_SESSION['userID']=$row['userID'];
              $_SESSION['userFullname']=$row['name'];
              $_SESSION['gender']=$row['gender'];
              $_SESSION['university']=$row['university'];
              $_SESSION['major']=$row['major'];
              $_SESSION['flatNum']=$row['flatNum'];
              $_SESSION['roomNum']=$row['roomNum'];
              $_SESSION['balance']=$row['balance'];
              $_SESSION['activated']=$row['activated'];
              header ("location:landlordIndex.php");
            }else{
              $_SESSION ['user']= $user;
              $_SESSION['userID']=$row['userID'];
              $_SESSION['userFullname']=$row['name'];
              $_SESSION['gender']=$row['gender'];
              $_SESSION['university']=$row['university'];
              $_SESSION['major']=$row['major'];
              $_SESSION['flatNum']=$row['flatNum'];
              $_SESSION['roomNum']=$row['roomNum'];
              $_SESSION['balance']=$row['balance'];
              $_SESSION['activated']=$row['activated'];
              header ("location:tenantIndex.php");
       //echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
            }

          }else{
            $error = " Email or Password is Wrong . Try Again ";
            //echo "<Label>alert(' Username or Password is invalid . Try Again');</Label>";
            //$pdo=NULL;
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
    <td class="labelTD"><font id="email">Email</font></td>
    <td class="inputTD"><input id="emailInput" type="text" name="email"  ></td>
    </tr>
    <tr>
    <td class="labelTD"><font id="password">Password</font></td>
    <td class="inputTD"><input id="passwordInput" type="password" name="password" ></td>
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
