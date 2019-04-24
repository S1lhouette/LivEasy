<?php
error_reporting(0);
include("connect.php");
session_start();


if(isset($_POST['submitBtn'])){
  $newConsumerNum=1;
  $newConsumerID=$_SESSION['userID'];
  $newConfirmState='1';

  if($_POST['userCheckbox1']=='on'){
    $newConsumerNum++;
    $newConfirmState=$newConfirmState.'0';
    $newConsumerID=$newConsumerID.",".$_POST['userID1'];
  }
  if($_POST['userCheckbox2']=='on'){
    $newConsumerNum++;
    $newConfirmState=$newConfirmState.'0';
    $newConsumerID=$newConsumerID.",".$_POST['userID2'];
  }
  if($_POST['userCheckbox3']=='on'){
    $newConsumerNum++;
    $newConfirmState=$newConfirmState.'0';
    $newConsumerID=$newConsumerID.",".$_POST['userID3'];
  }
  if($_POST['userCheckbox4']=='on'){
    $newConsumerNum++;
    $newConfirmState=$newConfirmState.'0';
    $newConsumerID=$newConsumerID.",".$_POST['userID4'];
  }
  if($_POST['userCheckbox5']=='on'){
    $newConsumerNum++;
    $newConfirmState=$newConfirmState.'0';
    $newConsumerID=$newConsumerID.",".$_POST['userID5'];
  }
  if($_POST['userCheckbox6']=='on'){
    $newConsumerNum++;
    $newConfirmState=$newConfirmState.'0';
    $newConsumerID=$newConsumerID.",".$_POST['userID6'];
  }

  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("insert into transactiontable values(default, ".$newConsumerNum.", '".$newConsumerID."', ".$_SESSION['userID'].", ".$_POST['amount'].", 'test.jpg', '".$_POST['transactionDate']."', '".$_POST['transactionType']."', '".$newConfirmState."', '0')");
    $pdo=NULL;

    header("location:finance.php");
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
        <link  rel="stylesheet" type="text/css" href="../css/addNewTrans.css">
        <script type="text/javascript" src="../js/addNewTrans.js"></script>
        <a href="tenantIndex.html"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
        <a href="tenantIndex.html" id="webName"><text id="title"> LivEasy </text></a>
        <a href="maintenance.htm"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
        <a href="timetable.html"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
        <a href = "finance.html"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
    </div>
</head>
<body id="background">
  	<div class="subtitles"> Add a new transaction <br> </div>
    <div id="left">
			<form name="moneyForm" id="moneyForm"  onsubmit="return canSubmit()" method="post" action="addNewTrans.php">
    		<div id="input">
  				<input type="text" id="moneyInput" placeholder="Enter the amount of money" onkeyup="checkNum(this)" name='amount'/>
  				<input type="submit" class="btn" id="submitBtn" name="submitBtn" value="Submit"/>
          <input type="date" value="<?php echo date("Y-m-d");?>" min="2015-09-16" max="2025-09-26" name="transactionDate"/>
          <select name= "transactionType">
            <option value="TestType">TestType</option>
          </select>
          <br/>
          <span class="hint" id="moneyHint"></span>
		    </div>

		    <div id="rcptDiv">
    			<label id="label"> Upload a receipt</label>
          <br/>
    			<input type="file" id="uploadRcpt" name="uploadRcpt" onchange="fileChange(this)"/>
		    </div>
    </div>


    <div id="right">
      <table id="memberTable">
        <?php
        try {
          $pdo=new PDO($dsn,$db_username,$db_password,$opt);
          $stmt=$pdo->query("select * from usertable where flatNum=".$_SESSION['flatNum']);
          $index=1;
          $userArr=array();
          while($row=$stmt->fetch()){
            if($row['userID']!=$_SESSION['userID']){
              echo "<tr><td><input type='checkbox' id='userCheckbox".$index."' name='userCheckbox".$index."'></td><td><img class='userIcon' src='../images/user.png' alt=''></td><td><label class='username' name='username1'>".$row['name']."</label></td><td><input type='hidden' name='userID".$index."' value='".$row['userID']."'/></td></tr>";
              array_push($userArr,'1234');
              $index++;
            }


          }


          $pdo=NULL;


        } catch (PDOException $e) {
          exit("PDO Error: ".$e->getMessage()."<br>");
        }
        ?>

      </table>
    </form>



    </div>
</body>
</html>
