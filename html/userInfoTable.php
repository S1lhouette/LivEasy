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

if(isset($_POST['delete'])){
  try {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stmt=$pdo->query("delete from usertable where userID=".$_POST['index']);

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
    Users Information
</div>
    <div id="tableDIV" style="overflow: scroll;overflow-x: hidden">

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
                $stmt=$pdo->query("select * from usertable group by flatNum");
                while($row=$stmt->fetch()){
                  if($row['userID']!=1){
                    echo "<form action='userInfoTable.php' method='post'>";
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['flatNum']."</td>";
                    echo "<td>".$row['roomNum']."</td>";
                    echo "<td><input type='hidden' name='index' value='".$row['userID']."'/></td>";
                    if($row['activated']==0){
                      echo "<td class='btnArea'><input type='submit' name='delete' value='Delete' class='deleteBtn' onclick='confirmDelete()'><input type='submit' name='activate' value='Activate' class='actBtn'></td>";
                    }else{
                      echo "<td class='btnArea'><input type='submit' name='delete' value='Delete' class='deleteBtn' onclick='confirmDelete()'></td>";
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
</body>
</html>
