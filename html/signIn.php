<?php
  $db_hostname = "localhost";
  $db_database = "comp208";
  $db_username = "root";
  $db_password = "";
  $db_charset = "utf8mb4";
  $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";
  $opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  );

if(isset($_POST['submit'])){
  try {
    //Connect to the database and search for the current capacity of each course
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("insert into usertable values(default,\"{$_POST['userName']}\",\"{$_POST['password']}\",\"{$_POST['name']}\",\"{$_POST['gender']}\",
    \"{$_POST['university']}\",\"{$_POST['major']}\",{$_POST['flatNum']},\"{$_POST['roomNum']}\",0,\"{$_POST['email']}\")");

    $pdo=NULL;

    header("location:login.php");
  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}



?>





<!DOCTYPE html>
<html>
<head>
    <link  rel="stylesheet" type="text/css" href="signUp.css">
    <script type="text/javascript" src="signUp.js"></script>
    <img id="logoSmall" src="logo.png" alt="logo">
    <text id="title"> LivEasy </text>
</head>
<body id="background">

<form action="signUp.php" method="post" name="registerForm">
  <div id="left">
    <div class="text">Name<br>
      <input class="textInput" id="firstName" type="text" name="name" onkeyup="checkNull('firstName')">
      <span class="hint" id="firstNameHint"></span>
    </div>

    <div class="text">User name<br>
      <input class="textInput" id="lastName" type="text" name="userName" onkeyup="checkNull('lastName')">
      <span class="hint" id="lastNameHint"></span>
    </div>

    <div class="text">Email<br>
      <input class="textInput" id="email" type="text" name="email"  onkeyup="isEmail()">
      <span class="hint" id="emailHint"></span>
    </div>

    <div class="text">Gender<br>
      <select class="dropList" name="gender">
        <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>

    <div class="text">Password<br>
        <input class="textInput"  id="psw1" type="password" name="password" >
    </div>

    <div class="text" >Confirm Password<br>
        <input class="textInput" id="psw2" type="password" name="confirmPassword" onkeyup="verifyPsw()">
        <span class="hint" id="pswHint"></span>
    </div>
</div>

<div id="right">
    <div class="text">Flat Number<br>
      <input class="textInput" id="flatNum" type="text" name="flatNum" onkeyup="isFlatNum()">
      <span class="hint" id="flatHint"></span>
    </div>

    <div class="text">Room Number<br>
      <input class="textInput"  id="roomNum" type="text" name="roomNum" onkeyup="isRoomNum()">
      <span class="hint" id="roomHint"></span>
    </div>

    <div class="text">University<br>
      <select class="dropList" name="university">
        <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
        <option value="University of Liverpool">University of Liverpool</option>
        <option value="Liverpool John Moores University">Liverpool John Moores University</option>
        <option value="Liverpool City College">Liverpool City College</option>
        <option value="The City of Liverpool College">The City of Liverpool College</option>
        <option value="Liverpool School of Tropical Medicine">Liverpool School of Tropical Medicine</option>>
      </select>
    </div>

    <div class="text">Major<br>
      <select class="dropList" name="major">
        <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
        <option value="Art">Art</option>
        <option value="Biological">Biological</option>
        <option value="Business">Business</option>
        <option value="Chemistry">Chemistry</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Dentistry">Dentistry</option>>
        <option value="Electrical and Electronic Engineering">Electrical and Electronic Engineering</option>
        <option value="English Literature">English Literature</option>
        <option value="History">History</option>
        <option value="Industrial Design">Industrial Design</option>
        <option value="Law">Law</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Ocean Sciences">Ocean Sciences</option>
        <option value="Physics">Physics</option>
        <option value="Sociology">Sociology</option>
        <option value="Urban Planning">Urban Planning</option>
        <option value="Veterinary Science">Veterinary Science</option>
        <option value="Zoology">Zoology</option>
      </select>
    </div>
  </div>
  <input id="registerBtn" type="submit" name="submit" value="Register"/>
</form>



</body>

</html>
