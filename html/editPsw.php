<?php
include("connect.php");
include("Validaccess.php");

if(isset($_POST["submit"])){
  if(strcmp($_POST['newpsw'],$_POST['confpsw'])==0){
    $password=password_hash($_POST['newpsw'],PASSWORD_DEFAULT);
    $pdo=new PDO($dsn,$db_username,$db_password,$opt);
   $stn=$pdo->query("select* from usertable where usertable.email='".$_POST['inpuemail']."'");
    if($row = $stn->fetch()){
        $stmt=$pdo->query("update usertable set password='".$password."' where usertable.email='".$_POST['inpuemail']."'");
    }else{
    echo "<script>alert('No such student.');</script>";
}
    $pdo=NULL;
  }
}


 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <div id = "head">
         <text id="logout"> Log out</text>
         <link  rel="stylesheet" type="text/css" href="../css/editPsw.css">
         <script type="text/javascript" src="../js/editPsw.js"></script>
         <a href="landlordIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
         <a href="landlordIndex.php" id="webName"><text id="title"> LivEasy </text></a>
     </div>
 </head>
 <body id="background">
 <div id="titleForThisPage">
     Change Password
 </div>
 <div id="changePsw">
     <form action="editPsw.php" method="post" name="pswForm" onsubmit="return myCheck()">
       <table id="dropListTbl">
           <tr>
               <td style="width: 2rem">
                   Email
                   <input type="text" name="inpuemail" id="emailInput">
               </td>
           </tr>
       </table>

     <br>
     <div id="pswDiv">
         <table>
             <tr>
                 <td class="nameTd">New Password</td> <td class="inputTd"><input name="newpsw"type="password" id="psw1" class="inputText" placeholder="alphanum and special symbol, length 8-16" onkeyup="checkPsw()"></td><td id="hint1"></td>
             </tr>
             <tr>
                 <td class="nameTd">Confirm Password</td> <td class="inputTd"><input name="confpsw" type="password" id="psw2" class="inputText" onkeyup="verifyPsw()"></td><td id="hint"></td>
             </tr>
         </table>
     </div>
     <input type="submit" value="Submit" id="submitBtn"name="submit">
     </form>
 </div>

 </body>
 </html>
