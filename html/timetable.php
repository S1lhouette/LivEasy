<?php
error_reporting(0);
include("Validaccess.php");
include("connect.php");
$userId=$_SESSION['userID'];
$userFullname=$_SESSION["userFullname"];
$date=date("Y-m-d");
if(isset($_POST['date'])){
  $date=str_replace(".","-",$_POST['date']);
}

if(isset($_POST['submit'])){
  if(isset($_POST['newDate'])){
  //  echo $_POST['newDate'];
    $date=str_replace(".","-",$_POST['newDate']);
  }
  try{
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
    $stringarray=explode("-",$_POST['time']);
    $first=0;
    $second=1;
    $starttime=$stringarray[$first];
    $endtime=end($stringarray);
    $stmt=$pdo->query("insert into scheduletable values(default,\"{$userId}\",\"{$date}\",\"{$starttime}\",\"{$endtime}\",\"{$_POST['event']}\")");
    $pdo=NULL;
  }catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
  }
}

if(isset($_POST['delete'])){
  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
  $stmt=$pdo->query("delete from scheduletable where scheduletable.bookID={$_POST['bookID']}");
  $pdo=NULL;
}
 ?>



 <!DOCTYPE html>
 <html lang="en">
 <head>
     <div id = "head">
         <text id="logout"> Log out</text>
         <link  rel="stylesheet" type="text/css" href="../css/timetable.css">
         <script type="text/javascript" src="../js/timetable.js"></script>
         <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
         <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
         <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
         <a href="finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
     </div>
 </head>
 <body id="background" onload="load(); fixRem(); window.addEventListener('resize', fixRem, false);">
     <div id="left">
             <div class='calendar' id='calendar'></div>
             <script type='text/javascript' src="../js/calendar.js"></script>
             <!--由于效果改变了，
             所以需要重写js中日历
            的效果，若太复杂把所有效果删掉也可以
            -->
     </div>
     <div id="right">
     <div id="selectedDay"></div><!--需要修改html或js代码，让此处只显示“My events”或
              All events” -->
         <div id="showEvent">
           <form action="timetable.php" method='post' id='form1'><input type="hidden" id='today' name='date'></input></form>
           <?php echo $date; //需要改变此处的外观，包括字体大小等?>
             <div id="theDayEvents" style="overflow: scroll;overflow-x: hidden">
               <div id="Allevent">
                   <?php
                   $pdo=new PDO($dsn,$db_username,$db_password,$opt);
                   echo "<form id='c1' class='show' action='timetable.php' method='post' name='timtableForm'>";
                   echo "<table border='0' id='eventsTable'>";
                     foreach ($pdo->query("select * from scheduletable natural join usertable where usertable.flatNum=\"{$_SESSION['flatNum']}\" and scheduletable.eventDate=\"{$date}\"order by scheduletable.starttime asc")as $row) {
                       echo "<tr><td>".$row['content']."</td><td>".$row['startTime']."</td><td>-".$row['endTime']."</td><td>".$row['name']."</td></tr>";
                       //上面这行 中的html代码需要修改，使得表看起来更美观
                     }
                  echo "</table></form>";
                   $pdo=NULL;
                   ?>
                 </div>
                 <div id="Myevent">
                   <?php
                    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
                    foreach ($pdo->query("select * from scheduletable where scheduletable.userID=\"{$userId}\" order by scheduletable.starttime asc") as $row) {
                      echo "<form id='c2' action='timetable.php' method='post' name='timtableForm'>";
                      echo "<table border='0' id='eventsTable'>";
                      echo "<tr><td>".$row['content']."</td><td><input type='hidden' name='bookID' value='".$row['bookID']."'/></td><td class='delete'><input type='submit' name='delete' value='Delete' class='deleteBtn' onclick='confirmDelete()'/></td></tr>";
                      //上面这行 中的html代码需要修改，使得表看起来更美观
                      echo "</table></form>";
                    }
                    $pdo=NULL;
                    ?>
                  </div>

                 </div>
         </div>
         <div id="inputArea">
             <text class="EandT">Event</text>
             <br>
             <form action="timetable.php" method="post">
             <input id="eventInput" type="text" name="event">
             <p></p>
             <text class="EandT">Time</text>
             <br>
             <select class="dropList" id="timeList" name="time">
                 <option selected="selected" disabled="disabled"  style='display: none' value=''></option>
                 <option value="00:00 - 01:00">00:00 - 01:00</option>
                 <option value="01:00 - 02:00">01:00 - 02:00</option>
                 <option value="02:00 - 03:00">02:00 - 03:00</option>
                 <option value="03:00 - 04:00">03:00 - 04:00</option>
                 <option value="04:00 - 05:00">04:00 - 05:00</option>
                 <option value="05:00 - 06:00">05:00 - 06:00</option>
                 <option value="06:00 - 07:00">06:00 - 07:00</option>
                 <option value="07:00 - 08:00">07:00 - 08:00</option>
                 <option value="08:00 - 09:00">08:00 - 09:00</option>
                 <option value="09:00 - 10:00">09:00 - 10:00</option>
                 <option value="10:00 - 11:00">10:00 - 11:00</option>
                 <option value="11:00 - 12:00">11:00 - 12:00</option>
                 <option value="12:00 - 13:00">12:00 - 13:00</option>
                 <option value="13:00 - 14:00">13:00 - 14:00</option>
                 <option value="14:00 - 15:00">14:00 - 15:00</option>
                 <option value="15:00 - 16:00">15:00 - 16:00</option>
                 <option value="16:00 - 17:00">16:00 - 17:00</option>
                 <option value="17:00 - 18:00">17:00 - 18:00</option>
                 <option value="18:00 - 19:00">18:00 - 19:00</option>
                 <option value="19:00 - 20:00">19:00 - 20:00</option>
                 <option value="20:00 - 21:00">20:00 - 21:00</option>
                 <option value="21:00 - 22:00">21:00 - 22:00</option>
                 <option value="22:00 - 23:00">22:00 - 23:00</option>
                 <option value="23:00 - 24:00">23:00 - 24:00</option>
             </select>
             <br>
             <input type="submit" name="submit" value="Add" id="idBtn" onclick="checkNull()">
             <input type="button" value="My Events" class="viewBtn" id="btn" onclick="changeToMyEvents()">
             <input type="hidden" value="<?php echo $date;?>" name="newDate"></input>
</form>
         </div>
     </div>
 </body>
 </html>
