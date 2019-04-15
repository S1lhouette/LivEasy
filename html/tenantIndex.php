<?php
//session_start ();
include("Validaccess.php");
include('connect.php');
$useremail=$_SESSION['user'];
//$userId=$_SESSION['userID'];
$userFullname=$_SESSION['userFullname'];
$anouomus=false;
$datetime= date('Y-m-d H:i:s');
echo"$datetime";

//echo "adding";
    if ( isset ($_POST ['submit'])) {//there is something wrong with the submit button;
      if(isset($_POST['Anonymous'])){
        $anouomus=true;
      }
  echo"adding msg";
  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
//  $stmt1=$pdo->query("select * from usertable where userId=\"{$userID}\"");
  $stmt=$pdo->query("insert into messagetable values(default,\"{$_SESSION['userID']}\",\"{$_POST['content']}\",default,\"{$_POST['type']}\")");
  $row=$stmt->fetch(PDO::FETCH_BOTH);
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
         <a href="tenantIndex.html"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
         <a href="tenantIndex.html" id="webName"><text id="title"> LivEasy </text></a>
         <a href="maintenance.htm"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
         <a href="timetable.html"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
         <a><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
     </div>
 </head>
 <body id="background" onload="load()">
 <div id="left">
     <button class="verticalBtn selected" id="allMsg" onclick="changeTab1()">All Messages</button>
     <br>
     <button class="verticalBtn" id="addMsg" onclick="changeTab2()">Add Messages</button>
     <br>
     <button class="verticalBtn" id="myMsg" onclick="changeTab3()">My Messages</button>
 </div>

 <div id="mid">
     <div class="show" id="c1" style="overflow:scroll; overflow-x:hidden;">
         <form>
             <table border="0" id="msgTable">
                 <tr>
                     <!-- <th class="msg">Message</th>
                     <th class="userName">User Name</th> -->
                 </tr>
                 <tr><td class="msg"><?php $pdo=new PDO($dsn,$db_username,$db_password,$opt);?></td><td class="userName"></td></tr>
                 <tr><td class="msg">Some text</td><td class="userName"></td></tr>
                 <tr><td class="msg">Some text</td><td class="userName"></td></tr>

             </table>
         </form>
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
         <form>
             <table border="0" id="myTable">
                 <tr>
                     <td class="msg">Message</td>
                     <td class="userName"></td>
                 </tr>
                 <tr><td class="msg">Some text</td><td class="delete"><button class="deleteBtn" onclick="confirmDelete()">Delete</button></td></tr>
                 <tr><td class="msg">Some text</td><td class="delete"><button class="deleteBtn" onclick="confirmDelete()">Delete</button></td></tr>
                 <tr><td class="msg">Some text</td><td class="delete"><button class="deleteBtn" onclick="confirmDelete()">Delete</button></td></tr>

             </table>
         </form>
     </div>
 </div>

 <div id="right">
     <p id="welcome"><?php echo"<span id='phpHint'>"."Welcome home,$userFullname"."</span>"?></p>
     <p class="smallerFont">Email: Email Address
     <br>
     Flat: 5  <br> Room:A</p>
     <p class="smallerFont">
         <a href="recommend.html" class="links">Find a flat to play?</a>
         <br>
         <br>
         <a href="editAccount.html" class="links">Edit account</a>
     </p>

 </div>

 </body>
 </html>
