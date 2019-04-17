<?php
error_reporting(0);
include('connect.php');
session_start();

if(isset($_POST['addMsgBtn'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("insert into messagetable values(default, 1, '".$_POST['content']."', default, 'public')");

    $pdo=NULL;
  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

if(isset($_POST['deleteBtn'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("delete from messagetable where msgID=".$_POST['msgID']);

    $pdo=NULL;
  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}



if(isset($_POST['finishBtn'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("select * from reporttable where reportID=".$_POST['reportID']);
    $row=$stmt->fetch();
    if($row['confirmState']=='01'){
      $newConfirmState='11';
      $newConfirmResult='1';
    }else if($row['confirmState']=='00'){
      $newConfirmState='10';
      $newConfirmResult=$row['confirmResult'];
    }else{
      $newConfirmState=$row['confirmState'];
      $newConfirmResult=$row['confirmResult'];
    }
    $stmt=$pdo->query("update reporttable set confirmState=".$newConfirmState.", confirmResult=".$newConfirmResult." where reportID=".$_POST['reportID']);

    $pdo=NULL;
  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport"content="initial-scale=1, maximum-scale= 1, minimum-scale=1, user-scalable=no">
    <link  rel="stylesheet" type="text/css" href="../css/landlordIndex.css">
    <script type="text/javascript" src="../js/landlordIndex.js"></script>

</head>
<body id="background">
  <div  id="head">
    <text id="logout"> Log out</text>
    <img id="logoSmall" src="../images/logo.png" alt="logo">
    <text id="title"> LivEasy </text>
  </div>
  <div id="body">
    <div id="left">
        <text id="billboardTitle" class="subTitile" onclick="viewBillboard()">Billboard</text>

        <div id="content">
          <div id="billboard" class="show">
            <table id="msgTable">
                <?php
                try {
                  $index=1;
                  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
                  $stmt=$pdo->query("select * from messagetable where userID=1 group by date desc");
                  while($row=$stmt->fetch()){
                    //var_dump($row);
                    echo "<form action='landlordIndex.php' method='post' name='showMsgForm'>";
                    echo "<tr>";
                    echo "<td>".$index.".</td>";
                    echo "<td class='msg'>".$row['content']."</td>";
                    $time=strtotime($row['date']);
                    echo "<td>".date('m',$time)."-".date('d',$time)."</td>";
                    echo "<td><input type='hidden' name='msgID' value='".$row['msgID']."'/></td>";
                    echo "<td><input type='submit' class='delete' name='deleteBtn' value='Delete' onclick='sub(document.showMsgForm)'/></td>";
                    echo "</tr>";
                    echo "</form>";
                    $index++;
                  }
                  $pdo=NULL;
                } catch (PDOException $e) {
                  exit("PDO Error: ".$e->getMessage()."<br>");
                }
                ?>
            </table>
          </div>

        <div id="textField" class="hide">
          <form id="newMsgF" action="landlordIndex.php" method="post" name="addMsgForm">
            <textarea rows="18" id="msgInput" placeholder="Add message here..." name="content"></textarea>
            <input type="submit" id="submitBtn" name="addMsgBtn" value="Submit" class="hide"/>
          </form>
        </div>
      </div>


      <img id="add" class="float" src="../images/plus.png" alt="" onclick="addMsg()">
        <a href="userInfoTable.php"><p id="userInfoBtn">View all tenants' information</p></a>
    </div>

    <div id="right">
      <text id="reportTitle" class="subTitile">Report Infomation</text>
      <div id="reportInfo">
        <table>
          <th class="facility">Facility</th><th class="notes">Note</th><th class="room">Flat/Room</th><th class="done">Done</th>
          <?php
          try {
            $pdo=new PDO($dsn,$db_username,$db_password,$opt);
            $stmt=$pdo->query("select * from reporttable inner join usertable on reporttable.userID=usertable.userID group by reportID desc");
            while($row=$stmt->fetch()){
              if($row['confirmState']=='00'||$row['confirmState']=='01'){
                echo "<form action='landlordIndex.php' method='post' name='showRptForm'>";
                echo "<tr>";
                echo "<td class='facility'>".$row['content']."</td>";
                echo "<td class='notes'>".$row['availableTime']."</td>";
                echo "<td class='room'>".$row['flatNum']."/".$row['roomNum']."</td>";
                echo "<td><input type='hidden' name='reportID' value='".$row['reportID']."'/></td>";
                echo "<td><input type='submit' name='finishBtn' value='Finish'/></td>";
                echo "</tr>";
                echo "</form>";
              }else if($row['confirmState']=='10'){
                echo "<form action='landlordIndex.php' method='post' name='showRptForm'>";
                echo "<tr>";
                echo "<td class='facility'>".$row['content']."</td>";
                echo "<td class='notes'>".$row['availableTime']."</td>";
                echo "<td class='room'>".$row['flatNum']."/".$row['roomNum']."</td>";
                echo "<td><input type='hidden' name='reportID' value='".$row['reportID']."'/></td>";
                echo "<td>Waiting for tenant's confirmation</td>";
                echo "</tr>";
                echo "</form>";
              }

            }
            $pdo=NULL;
          } catch (PDOException $e) {
            exit("PDO Error: ".$e->getMessage()."<br>");
          }
          ?>
        </table>
      </div>
      <img id="alarm" src="../images/exclamation.png" alt="">
    </div>

  </div>
</body>
</html>
