<?php
error_reporting(0);
include('connect.php');
include('validaccessland.php');
if(isset($_POST['delete'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("select * from usertable where userID=".$_POST['index']);
    $row=$stmt->fetch();
    if($row['isLeader']==0){
      $stmt2=$pdo->query("delete from usertable where userID=".$_POST['index']);
    }else{
      $stmt2=$pdo->query("select * from usertable where flatNum=".$row['flatNum']);
      $row2=$stmt2->fetch();
      if($row2['isLeader']==0){
        $stmt3=$pdo->query("update usertable set isLeader=1 where userID=".$row2['userID']);
      }
      $stmt4=$pdo->query("delete from usertable where userID=".$_POST['index']);
    }



    $pdo=NULL;
  } catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

if(isset($_POST['activate'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("update usertable set activated=1 where userID=".$_POST['index']);
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
        <text id="logout"> Log out</text>
        <link  rel="stylesheet" type="text/css" href="../css/userInfoTable.css">
        <script type="text/javascript" src="../js/userInfoTable.js"></script>
        <a href="landlordIndex.html"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
        <a href="landlordIndex.html" id="webName"><text id="title"> LivEasy </text></a>
    </div>
</head>
<body id="background">
<div id="titleForThisPage">
    User Information
</div>
    <div id="tableDIV" style="overflow: scroll;overflow-x: hidden">
        <div>
            <table border="0" id="myEventsTable">
              <tr class="tableTitle">
                <td>Name</td>
                <td>Flat No.</td>
                <td>Room No.</td>
                <td></td>
              </tr>
              <?php
              try {
                $pdo=new PDO($dsn,$db_username,$db_password,$opt);
                $stmt=$pdo->query("select * from usertable order by flatNum");
                while($row=$stmt->fetch()){
                  if($row['userID']!=1){
                    echo "<form action='userInfoTable.php' method='post'>";
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['flatNum']."</td>";
                    echo "<td>".$row['roomNum']."</td>";
                    echo "<td><input type='hidden' name='index' value='".$row['userID']."'/></td>";
                    if($row['activated']==0){
                      echo "<td class='btnArea'><input type='submit' name='delete' value='Delete' class='deleteBtn' onclick='confirmDelete()'/><input type='submit' name='activate' value='Activate' class='actBtn'/></td>";
                    }else{
                      echo "<td class='btnArea'><input type='submit' name='delete' value='Delete' class='deleteBtn' onclick='confirmDelete()'/></td>";
                    }
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
    </div>
</body>
</html>
