<?php
error_reporting(0);
session_start();
include('connect.php');

if(!isset($_SESSION['userID'])){
    echo "<script type='text/javascript'>alert('Sorry, you should log in first.'); window.location.href = 'login.php';</script>";
}

if(isset($_POST['Save'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $name=$_POST['firstName']." ".$_POST['lastName'];
    $hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $stmt=$pdo->query("update usertable set name='".$name."', password='".$hash."', university='".$_POST['university']."', major='".$_POST['major']."' where userID=".$_SESSION['userID']);

    $pdo=NULL;
    echo "<script type='text/javascript'>alert('The information of the account has been editted. Please log in again.'); window.location.href = 'login.php';</script>";


//header ("location:login.php");

  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

?>




<!DOCTYPE html>
<html>

<head>
    <link  rel="stylesheet" type="text/css" href="../css/editAccount.css">
    <script type="text/javascript" src="../js/editAccount.js"></script>
</head>

<body id="background">
    <div id = "head">
      <a href="logout.php" id="logout"> Log out</a>
        <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
        <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
        <a href="tenantIndex.php"><button class="navigation" id="myBillboard" name="myBillboard">My Billboard</button></a>
        <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
        <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
        <a href="finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
    </div>

     <div id="body">
      <div id="subTitile"> My Account </div>
      <form name="editForm" onsubmit="return myCheck()" action="editAccount.php" method="post">
        <div class="text">First Name<br/>
          <input class="textInput" id="firstName" type="text" name="firstName" placeholder="please enter your firstname" onkeyup="checkNull('firstName')"/>
          <span class="hint" id="firstNameHint"></span>
        </div>

        <div class="text">Last Name<br/>
          <input class="textInput" id="lastName" type="text" name="lastName" placeholder="please enter your lastname" onkeyup="checkNull('lastName')"/>
          <span class="hint" id="lastNameHint"></span>
        </div>

          <div class="text" >Password<br/>
                <input class="textInput" id="psw1" type="password" name="password" placeholder="alphanum and special symbol, length 8-16" onkeyup="checkPsw()"/>
              <span class="hint" id="firstPswHint"></span>
          </div>

          <div class="text" >Confirm Password<br/>
              <input class="textInput" id="psw2" type="password" name="confirmPassword" placeholder="please enter your password again" onkeyup="verifyPsw()"/>
              <span class="hint" id="pswHint"></span>
          </div>

          <div class="text">University<br>
              <select class="textInput"  id="flatNum" name="university">
                  <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
                  <option value="University of Liverpool">University of Liverpool</option>
                  <option value="Liverpool John Moores University">Liverpool John Moores University</option>
                  <option value="Liverpool City College">Liverpool City College</option>
                  <option value="The City of Liverpool College">The City of Liverpool College</option>
                  <option value="Liverpool School of Tropical Medicine">Liverpool School of Tropical Medicine</option>
              </select>
          </div>

          <div class="text">Major<br>
              <select class="textInput"  id="roomNum" name="major">
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
          <div id="btns">
              <input type="submit" id="saveBtn" name="Save" value="Save"/>
          </div>
    </form>

    </div>
</body>


</html>
