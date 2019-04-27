<?php
error_reporting(0);
session_start();
include('connect.php');

if(!isset($_SESSION['userID'])){
    echo "<script type='text/javascript'>alert('Sorry, you should log in first.'); window.location.href = 'login.php';</script>";
}

if(isset($_POST['topup'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);

    if($_POST['amount1']>0){
      $stmt=$pdo->query("select * from usertable where userID=".$_POST['userID1']);
      $row=$stmt->fetch();
      $newBalance=$row['balance']+$_POST['amount1'];
      $stmt2=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_POST['userID1']);
    }

    if($_POST['amount2']>0){
      $stmt=$pdo->query("select * from usertable where userID=".$_POST['userID2']);
      $row=$stmt->fetch();
      $newBalance=$row['balance']+$_POST['amount2'];
      $stmt2=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_POST['userID2']);
    }

    if($_POST['amount3']>0){
      $stmt=$pdo->query("select * from usertable where userID=".$_POST['userID3']);
      $row=$stmt->fetch();
      $newBalance=$row['balance']+$_POST['amount3'];
      $stmt2=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_POST['userID3']);
    }

    if($_POST['amount4']>0){
      $stmt=$pdo->query("select * from usertable where userID=".$_POST['userID4']);
      $row=$stmt->fetch();
      $newBalance=$row['balance']+$_POST['amount4'];
      $stmt2=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_POST['userID4']);
    }

    if($_POST['amount5']>0){
      $stmt=$pdo->query("select * from usertable where userID=".$_POST['userID5']);
      $row=$stmt->fetch();
      $newBalance=$row['balance']+$_POST['amount5'];
      $stmt2=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_POST['userID5']);
    }

    if($_POST['amount6']>0){
      $stmt=$pdo->query("select * from usertable where userID=".$_POST['userID6']);
      $row=$stmt->fetch();
      $newBalance=$row['balance']+$_POST['amount6'];
      $stmt2=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_POST['userID6']);
    }


    $pdo=NULL;


  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <div id = "head">
        <input type="submit" id="logout" value="Log out" onclick="return confirmLogout()">
        <link  rel="stylesheet" type="text/css" href="../css/topup.css">
        <script type="text/javascript" src="../js/topup.js"></script>
        <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
        <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
        <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
        <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
        <a href = "finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
    </div>
</head>
<body id="background">
<div id="tinyTitle">Top-up for roommates</div>
<form id="topupForm" onsubmit="return myCheck()" action="topup.php" method="post" name="topupForm">
<table id="topupTable">
  <?php
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);

    $stmt=$pdo->query("select * from usertable where flatNum=".$_SESSION['flatNum']);
    $row1=$stmt->fetch();
    $row2=$stmt->fetch();
    $row3=$stmt->fetch();
    $row4=$stmt->fetch();
    $row5=$stmt->fetch();
    $row6=$stmt->fetch();

    echo "<tr>";

    if(isset($row1['userID'])){
      echo "<td><img src='../images/user.png'/></td>";
      echo "<td><div class='userName'>".$row1['name']."<div/></td>";
      echo "<td><input type='text' class='topupInput' id='input1' onkeyup='checkNumber(this)' name='amount1'/></td>";
      echo "<td><input type='hidden' name='userID1' value='".$row1['userID']."'></td>";
    }

    if(isset($row2['userID'])){
      echo "<td><img src='../images/user.png'/></td>";
      echo "<td><div class='userName'>".$row2['name']."<div/></td>";
      echo "<td><input type='text' class='topupInput' id='input2' onkeyup='checkNumber(this)' name='amount2'/></td>";
      echo "<td><input type='hidden' name='userID2' value='".$row2['userID']."'></td>";
    }

    if(isset($row3['userID'])){
      echo "<td><img src='../images/user.png'/></td>";
      echo "<td><div class='userName'>".$row3['name']."<div/></td>";
      echo "<td><input type='text' class='topupInput' id='input3' onkeyup='checkNumber(this)' name='amount3'/></td>";
      echo "<td><input type='hidden' name='userID3' value='".$row3['userID']."'></td>";
    }

    echo "</tr>";

    echo "<tr>";

    if(isset($row4['userID'])){
      echo "<td><img src='../images/user.png'/></td>";
      echo "<td><div class='userName'>".$row4['name']."<div/></td>";
      echo "<td><input type='text' class='topupInput' id='input4' onkeyup='checkNumber(this)' name='amount4'/></td>";
      echo "<td><input type='hidden' name='userID4' value='".$row4['userID']."'></td>";
    }

    if(isset($row5['userID'])){
      echo "<td><img src='../images/user.png'/></td>";
      echo "<td><div class='userName'>".$row5['name']."<div/></td>";
      echo "<td><input type='text' class='topupInput' id='input5' onkeyup='checkNumber(this)' name='amount5'/></td>";
      echo "<td><input type='hidden' name='userID5' value='".$row5['userID']."'></td>";
    }

    if(isset($row6['userID'])){
      echo "<td><img src='../images/user.png'/></td>";
      echo "<td><div class='userName'>".$row6['name']."<div/></td>";
      echo "<td><input type='text' class='topupInput' id='input6' onkeyup='checkNumber(this)' name='amount6'/></td>";
      echo "<td><input type='hidden' name='userID6' value='".$row6['userID']."'></td>";
    }

    echo "</tr>";

    $pdo=NULL;





  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }


   ?>

</table>
    <div id="hint"></div>
<input type="submit" id="submitBtn" value="Top-up" name="topup">
</form>
</body>
</html>
