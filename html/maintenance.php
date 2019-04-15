<?php
error_reporting(0);
session_start();
include('connect.php');

if(isset($_POST['addBtn'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $msg="insert into reporttable values(default, ".$_SESSION['userID'].", '".$_POST['facility']."', '".$_POST['note']."', '00', '0')";
    $stmt=$pdo->query($msg);

    $pdo=NULL;


  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

if(isset($_POST['finish'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $msg="select * from reporttable where reportID=".$_POST['reportID'];
    $stmt=$pdo->query($msg);
    $row=$stmt->fetch();
    if($row['confirmState']=='00'){
      $newConfirmState='01';
    }else if($row['confirmState']=='10'){
      $newConfirmState='11';
    }else{
      $newConfirmState=$row['confirmState'];
    }
    $msg="update reporttable set confirmState='".$newConfirmState."' where reportID=".$_POST['reportID'];
    $stmt=$pdo->query($msg);


    $pdo=NULL;


  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}





?>



<!DOCTYPE html>
<html>
<head>
  <div id = "head">
    <text id="logout"> Log out</text>
    <link  rel="stylesheet" type="text/css" href="../css/maintenance.css">
    <script type="text/javascript" src="../js/maintenance.js"></script>
	  <a href="tenantIndex.html"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
	  <a href="tenantIndex.html" id="webName"><text id="title"> LivEasy </text></a>
	  <a href="maintenance.html"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
	  <a href="timetable.html"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
	  <a><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
  </div>
</head>
<body id="background">
    <div id="body">
		<div class="maintenanceTable" style="overflow:scroll; overflow-x:hidden;">
			<table id = "maintTable" >
				<thead>
					<tr>
						<th>Facility</th>
						<th>Note</th>
						<th></th>
					</tr>
				</thead>
        <?php
        try {
          $pdo=new PDO($dsn,$db_username,$db_password,$opt);
          $msg="select * from reporttable where userID=".$_SESSION['userID'];
          $stmt=$pdo->query($msg);
          while($row=$stmt->fetch()){
            echo "<form action='maintenance.php' method='post' name='maintenanceForm'>";
            echo "<tr class='cell'>";
            echo "<td class='facilityName'>".$row['content']."</td>";
            echo "<td class='note'>".$row['availableTime']."</td>";
            echo "<td><input type='hidden' name='reportID' value='".$row['reportID']."'/></td>";
            echo "<td class='finish'><input type='submit' name='finish' value='Finish'/></td>";
            echo "</form>";
          }
          $pdo=NULL;


        } catch (PDOException $e) {
          exit("PDO Error: ".$e->getMessage()."<br>");
        }
        ?>
			</table>
		</div>

		  <div class="text">
        <form action="maintenance.php" method="post" name="maintenanceAddForm">
				  <label for="facility">Facility</label>
			  	<input class="textInput" id="facility" type="text" name="facility" placeholder="Facility that needs repairing">
				  <label for="note">Notes</label>
				  <input class="textInput" id="note" type="text" name="note" placeholder="Available times, details etc">
			  	<input type="submit" value="Add" class="btn" id="addBtn" name="addBtn" onclick="checkNull()"/>
        </form>
		  </div>
</div>
</body>


</html>
