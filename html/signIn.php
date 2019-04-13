<?php
  error_reporting(0);

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
  $label="";
  try {
    $flag="true";
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("select * from usertable");
    while($row=$stmt->fetch()){
      if($row['email']==$_POST['email']||($row['flatNum']==$_POST['flatNum']&&$row['roomNum']==$_POST['roomNum'])){
        $flag="false";
      }
    }

    if($flag=="true"){
      $name=$_POST['firstName']." ".$_POST['lastName'];
      $stmt=$pdo->query("insert into usertable values(default,\"{$_POST['password']}\",\"{$name}\",\"{$_POST['gender']}\",
      \"{$_POST['university']}\",\"{$_POST['major']}\",{$_POST['flatNum']},\"{$_POST['roomNum']}\",0,\"{$_POST['email']}\",0)");

      echo "<script>alert('The application has been sent to the landlord. Please wait for his activating of your account.')</script>";
      header("location:login.php");
    }else{
      $label="This email has been used or the owner of the room has registered.";
    }

    $pdo=NULL;


  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}



?>





<!DOCTYPE html>
<html>
<head>
    <!-- <meta name="viewport"content="initial-scale=1, maximum-scale= 1, minimum-scale=1, user-scalable=no"> -->
    <link  rel="stylesheet" type="text/css" href="../css/signIn.css">
    <script type="text/javascript" src="../js/signIn.js"></script>

</head>

<body id="background">
  <div  id="head">
    <img id="logoSmall" src="../images/logo.png" alt="logo">
    <text id="title"> LivEasy </text>
  </div>
<form action="signIn.php" name="signInForm" method="post">
  <div id="left">
    <div class="text">First Name<br/>
      <input class="textInput" id="firstName" type="text" name="firstName" onkeyup="checkNull('firstName')"/>
      <span class="hint" id="firstNameHint"></span>
    </div>

    <div class="text">Last Name<br/>
      <input class="textInput" id="lastName" type="text" name="lastName" onkeyup="checkNull('lastName')"/>
      <span class="hint" id="lastNameHint"></span>
    </div>

    <div class="text">Email<br/>
      <input class="textInput" id="email" type="text" name="email"  onkeyup="isEmail()"/>
      <span class="hint" id="emailHint"></span>
    </div>

    <div class="text">Gender<br/>
      <select class="dropList" name= "gender">
        <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>

    <div class="text">Password<br/>
        <input class="textInput"  id="psw1" type="password" name="password" />
    </div>

    <div class="text" >Confirm Password<br/>
        <input class="textInput" id="psw2" type="password" name="confirmPassword" onkeyup="verifyPsw()"/>
        <span class="hint" id="pswHint"></span>
    </div>
</div>

<div id="right">
    <div class="text">Flat Number<br/>
      <input class="textInput" id="flatNum" type="text" name="flatNum" onkeyup="isFlatNum()"/>
      <span class="hint" id="flatHint"></span>
    </div>

    <div class="text">Room Number<br/>
      <input class="textInput"  id="roomNum" type="text" name="roomNum" onkeyup="isRoomNum()"/>
      <span class="hint" id="roomHint"></span>
    </div>

    <div class="text">University<br/>
      <select class="dropList" name="university">
        <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
        <option value="University of Liverpool">University of Liverpool</option>
        <option value="Liverpool John Moores University">Liverpool John Moores University</option>
        <option value="Liverpool City College">Liverpool City College</option>
        <option value="The City of Liverpool College">The City of Liverpool College</option>
        <option value="Liverpool School of Tropical Medicine">Liverpool School of Tropical Medicine</option>
      </select>
    </div>

    <div class="text">Major<br/>
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
      <input type="submit" id="registerBtn" name="submit" value="Register"/>
      <div id="hintDiv">
      <!-- <span id='phpHint'></span> -->
      <?php
  if($label!="") {
    echo "<span id='phpHint'>".$label."</span>";
  }
    ?>
      </div>



  </div>


</form>

</body>

</html>
