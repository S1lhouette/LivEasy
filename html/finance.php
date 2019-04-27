<?php
error_reporting(0);
include("connect.php");
session_start();

if(!isset($_SESSION['userID'])){
    echo "<script type='text/javascript'>alert('Sorry, you should log in first.'); window.location.href = 'login.php';</script>";
}



if(isset($_POST['confirmTransaction'])){
  $transactionID=$_POST['transactionID'];
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("select * from transactiontable where transactionID=".$transactionID);
    $row=$stmt->fetch();
    $cost=$row['amount']/$row['consumerNum'];
    $payerID=$row['payerID'];
    $consumerList=$row['consumerID'];
    $consumerIDArray=explode(',',$consumerList);
    $index=0;
    $targetIndex=-1;
    foreach($consumerIDArray as $id){
      if($id==$_SESSION['userID']){
        $targetIndex=$index;
      }
      $index++;
    }
    $newConfirmState=$row['confirmState'];
    $newConfirmState{$targetIndex}='1';
    if(strstr($newConfirmState,"0")==false){
      $newConfirmResult=1;
    }else{
      $newConfirmResult=0;
    }
    $stmt=$pdo->query("update transactiontable set confirmState='".$newConfirmState."', confirmResult='".$newConfirmResult."' where transactionID=".$transactionID);

    $stmt=$pdo->query("select * from usertable where userID=".$_SESSION['userID']);
    $row=$stmt->fetch();
    $newBalance=$row['balance']-$cost;
    $stmt=$pdo->query("update usertable set balance=".$newBalance." where userID=".$_SESSION['userID']);

    $stmt=$pdo->query("select * from usertable where userID=".$payerID);
    $row=$stmt->fetch();
    $newBalance=$row['balance']+$cost;
    $stmt=$pdo->query("update usertable set balance=".$newBalance." where userID=".$payerID);



    $pdo=NULL;
  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>".$transactionID);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <div id = "head">
		<input type="submit" id="logout" value="Log out" onclick="return confirmLogout()">
        <link  rel="stylesheet" type="text/css" href="../css/finance.css">
		<script type="text/javascript" src="../js/finance.js"></script>
        <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
        <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
        <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
        <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
        <a href = "finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
    </div>
</head>
<body id="background">
    <div id="left">
		<div class = "subtitles"> Accounting <br> </div>
		<div id = "transactionDiv" style="overflow: scroll; overflow-x: hidden; border-style: none">
			<table id = "accountingTable">
				<thead>
					<tr>
						<th>Date</th>
            <th>Total Amount</th>
            <th>Consumer Number</th>
						<th>Payer</th>
						<th>Cost</th>
					</tr>
				</thead>
        <?php
        try {
          $pdo=new PDO($dsn,$db_username,$db_password,$opt);
          $stmt=$pdo->query("select * from transactiontable inner join usertable on transactiontable.payerID=usertable.userID");
          while($row=$stmt->fetch()){
            $consumerList=$row['consumerID'];
            $consumerIDArray=explode(',',$consumerList);
            $index=0;
            $targetIndex=-1;
            foreach($consumerIDArray as $id){
              if($id==$_SESSION['userID']){
                $targetIndex=$index;
                $confirmStr=$row['confirmState'];
                if(substr($confirmStr,$targetIndex,1)=="1"){
                  echo "<tr class='cell'>";
                  echo "<td class='date'>".$row['transactionDate']."</td>";
                  echo "<td>&#163;".$row['amount']."</td>";
                  echo "<td>".$row['consumerNum']."</td>";
                  echo "<td class='payer'>".$row['name']."</td>";
                  $amount=$row['amount']/$row['consumerNum'];
                  echo "<td class='cost'>&#163;".$amount."</td>";
                  echo "</td>";
                }
              }
              $index++;
            }
          }

          $pdo=NULL;
        } catch (PDOException $e) {
          exit("PDO Error: ".$e->getMessage()."<br>");
        }
        ?>




			</table>
			<br>
		</div>

		<div class = "text" id = "bal">
      <?php
      try {
        $pdo=new PDO($dsn,$db_username,$db_password,$opt);
        $stmt=$pdo->query("select * from usertable where userID=".$_SESSION['userID']);
        $row=$stmt->fetch();
        echo "Balance: ".$row['balance']."&#163";
        $isLeader=$row['isLeader'];
        $pdo=NULL;
      } catch (PDOException $e) {
        exit("PDO Error: ".$e->getMessage()."<br>");
      }

      ?>
		</div>

		<div class = "text">
			<a href = "addNewTrans.php" class = "links"><br/><br/>Add a new transaction</a><br/>
      <?php
      if($isLeader==1){
        echo "<a href = 'topup.php' class = 'links'><br/><br/>Top up for roommates</a><br/>";
      }
      ?>
		</div>

    </div>

    <div id="right">
        <div class = "subtitles"> Confirm list <br> </div>
		<div id = "confirmDiv" style="overflow: scroll; overflow-x: hidden;">
			<div id = "confForm">
			<table id = "confirmTable" >
        <?php
        try {
          $pdo=new PDO($dsn,$db_username,$db_password,$opt);
          $stmt=$pdo->query("select * from transactiontable inner join usertable on transactiontable.payerID=usertable.userID");
          while($row=$stmt->fetch()){
            $consumerList=$row['consumerID'];
            $consumerIDArray=explode(',',$consumerList);
            $index=0;
            $targetIndex=-1;
            foreach($consumerIDArray as $id){
              if($id==$_SESSION['userID']){
                $targetIndex=$index;
                $confirmStr=$row['confirmState'];
                if(substr($confirmStr,$targetIndex,1)=="0"){
                  echo "<form name='confirmRow' action='finance.php' method='post'>";
                  echo "<tr class='cell'>";
                  echo "<td class='date'>".$row['transactionDate']."</td>";
                  $amount=$row['amount']/$row['consumerNum'];
                  echo "<td class='cost'>&#163;".$amount."</td>";
                  echo "<td>payer:".$row['name']."</td>";
                  echo "<td>".$row['consumerNum']." consumers</td>";
                  echo "<td class='receipt'><a href='../".$row['picUrl']."' target='_blank' class='links'>View receipt</a></td>";
                  echo "<td><input type='hidden' value='".$row['transactionID']."' name='transactionID'/></td>";
                  echo "<td class='confirm'><input type='submit' class='btn confirmBtn' name='confirmTransaction' value='Confirm'></td>";
                  echo "</tr>";
                  echo "</form>";
                }

              }
              $index++;
            }

          }

          $pdo=NULL;
        } catch (PDOException $e) {
          exit("PDO Error: ".$e->getMessage()."<br>");
        }

        ?>
			</table>
			</div>
			<br>
		</div>
    </div>
</body>
</html>
