<?php
//session_start ();
error_reporting(0);
include("Validaccess.php");
include('connect.php');
$useremail=$_SESSION['user'];
//$userId=$_SESSION['userID'];
$userFullname=$_SESSION['userFullname'];
$anouomus=false;

if ( isset ($_POST ['submit'])) {
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
      if(isset($_POST['Anonymous'])){
          $stmt=$pdo->query("insert into messagetable values(default,\"{$_SESSION['userID']}\",\"{$_POST['content']}\",default,\"{$_POST['type']}\",1)");
      }
else{
    $stmt=$pdo->query("insert into messagetable values(default,\"{$_SESSION['userID']}\",\"{$_POST['content']}\",default,\"{$_POST['type']}\",0)");
}
  $row=$stmt->fetch(PDO::FETCH_BOTH);
  $pdo=NULL;
}

if(isset($_POST['delete'])){
  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
  $stmt=$pdo->query("delete from messagetable where messagetable.msgID={$_POST['msgID']}");
  $pdo=NULL;
}

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <div id = "head">
         <text id="logout"> Log out</text>
         <link  rel="stylesheet" type="text/css" href="../css/tenantIndex.css">
         <script type="text/javascript" src="../js/tenantIndex.js"></script>
         <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
         <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
         <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
         <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
         <a href="finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
     </div>
 </head>
 <body id="background">
 <div id="left">
     <button class="verticalBtn selected" id="allMsg" onclick="changeTab1()">All Messages</button>
     <br>
     <button class="verticalBtn" id="addMsg" onclick="changeTab2()">Add Messages</button>
     <br>
     <button class="verticalBtn" id="myMsg" onclick="changeTab3()">My Messages</button>
 </div>

 <div id="mid">
     <div class="show" id="c1" style="overflow:scroll; overflow-x:hidden;">
               <?php
                $pdo=new PDO($dsn,$db_username,$db_password,$opt);
                foreach ($pdo->query("select * from messagetable natural join usertable where usertable.flatNum=\"{$_SESSION['flatNum']}\" order by messagetable.date desc")as $row) {
                  echo "<form action='tenantIndex.php' method='post' name='tenantIndexForm'>";
                  echo "<table border='0' id='msgTable'>";
                  if($row['anonymous']==1){
                    echo "<tr><td class='msg'>".$row['content']."</td><td class='userName'>Anonymous</td></tr>";
                  }else if($row['anonymous']==0){
                    echo "<tr><td class='msg'>".$row['content']."</td><td class='userName'>".$row['name']."</td></tr>";
                  }
                }
                $pdo=NULL;
                 echo "</table></form>";
                ?>
     </div>
     <div id="c2">
         <form action="tenantIndex.php" method="post">
             <textarea name="content" rows="20" id="msgInput" placeholder="Add message here..."></textarea>
             <!--there should be an input for the text, otherwise backend cant get the type of the text-->
             <br>
             <label class="foot">Label</label>
             <!--there should be an input for the label, otherwise backend cant get the type of the message-->
             <select  id="dropList" name="type">
                 <option selected="selected" disabled="disabled"></option>
                 <option value="Daily life">Daily life</option>
                 <option value="Entertainment">Entertainment</option>
                 <option value="Study">Study</option>
                 <option value="Sport">Sport</option>
             </select>
             <!--<label class="foot" id="checkBox"><input type="checkbox" name="check">Anonymous</label>-->
             <input name="Anonymous" type="checkbox" value="Anonymous" id="checkBox">
             <label class="foot" id="anonymous">Anonymous</label>
             <input type="submit" id="submitBtn" onclick="checkNull()" value="Submit" name="submit"></input>
         </form>
     </div>

     <div id="c3" style="overflow:scroll; overflow-x:hidden;">
                <?php
                 $pdo=new PDO($dsn,$db_username,$db_password,$opt);
                 foreach ($pdo->query("select * from messagetable where messagetable.userID=\"{$_SESSION['userID']}\" order by messagetable.date desc") as $row) {
                   $msgID=$row['msgID'];
                   echo "<form action='tenantIndex.php' method='post' name='tenantIndexForm'>";
                   echo "<table border='0' id='msgTable'>";
                   echo "<tr><td>".$row['content']."</td><td><input type='hidden' name='msgID' value='".$row['msgID']."'/></td><td class='delete'><input type='submit' name='delete' value='Delete' class='btn finishBtn'/></td></tr>";
                   echo "</table></form>";
                 }
                 $pdo=NULL;
                 ?>
     </div>
 </div>

 <div id="right">
     <p id="welcome"><?php echo"<span id='phpHint'>"."Welcome home,$userFullname"."</span>"?></p>
     <p class="smallerFont"><br><?php echo"<span id='phpHint'>"."Email:$useremail"."</span>"?></p>
     <br>
     <?php $flatNum=$_SESSION['flatNum'];echo"<span id='phpHint'>"."Flat:$flatNum"."</span>"?> <br> Room:A</p>
     <p class="smallerFont">
         <a href="recommend.html" class="links">Find a flat to play?</a>
         <br>
         <br>
         <a href="editAccount.php" class="links">Edit account</a>
     </p>

 </div>

 </body>
 </html>
