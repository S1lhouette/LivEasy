<?php
include('Validaccess.php');
include('connect.php');
$flatNum=$_SESSION['flatNum'];
$userId=$_SESSION['userID'];
$major=array();
$type=array();
$university=array();
$gender=array();
if(isset($_POST['invite'])){
  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
  $invitecontent="*Flat".$flatNum."invites you to be their friends.";
  $stmt=$pdo->query("insert into messagetable values(default,\"{$userId}\",\"{$invitecontent}\",default,\"{$_POST['Daily']}\",0)");
  $pdo=NULL;
}

$pdo=new PDO($dsn,$db_username,$db_password,$opt);
foreach($pdo->query("select * from messagetable natural join usertable where usertable.flatNum=\"{$flatNum}\"")as $row){
  $type[]=$row['type'];
  $major[]=$row['major'];
  $university[]=$row['university'];
  $gender[]=$row['gender'];
}
$male=0;
foreach($gender as $a){
  if($a=='Male'){
    $male=$male+1;
  }
}
$recomajor=max(array_count_values($major));
$rocuniv=max(array_count_values($university));
$rectype=max(array_count_values($type));
$genderratio=$male/count($gender);

$flats=array();
foreach($pdo->query("select * from messagetable natural join usertable")as $row){
  $flats[]=$row['flatNum'];
}

$resultlist=array();
$recoflat=NULL;

function getrecommend($type,$flats,$flatNum){
  foreach(array_keys(array_count_values($flats)) as $sinflat){
    if($sinflat!=$flatNum&&$sinflat!=0){
      $ctn=0;
      $thismajor=array();
      $thistype=array();
      $thisuniversity=array();
      $thisgender=array();
      foreach($pdo->query("select * from messagetable natural join usertable where usertable.flatNum=\"{$sinflat}\" and usertable.flatNum!=\"{$flatNum}\"") as $row){
        $thistype[]=$row['type'];
        $thismajor[]=$row['major'];
        $thisuniversity[]=$row['university'];
        $thisgender[]=$row['gender'];
      }
      $male=0;
      foreach($thisgender as $a){
        if($a=='Male'){
          $male=$male+1;
        }
      }
      $trecomajor=max(array_count_values($major));
      $trocuniv=max(array_count_values($university));
      $trectype=max(array_count_values($type));
      $tgenderratio=$male/count($gender);
      if(strcmp($type,"genderratio")==0){
        if(abs($genderratio-$tgenderratio)<=0.2){
          $ctn=$ctn+1.5;
        }
        if($recomajor==$trecomajor){
          $ctn=$ctn+1;
        }
        if($rectype==$trectype){
          $ctn=$ctn+1;
        }
        if($rocuniv==$trocuniv){
          $ctn=$ctn+1;
        }
      }else if(strcmp($type,"major")){
        if(abs($genderratio-$tgenderratio)<=0.2){
          $ctn=$ctn+1;
        }
        if($recomajor==$trecomajor){
          $ctn=$ctn+1.5;
        }
        if($rectype==$trectype){
          $ctn=$ctn+1;
        }
        if($rocuniv==$trocuniv){
          $ctn=$ctn+1;
        }
      }else if(strcmp($type,"university")){
        if(abs($genderratio-$tgenderratio)<=0.2){
          $ctn=$ctn+1;
        }
        if($recomajor==$trecomajor){
          $ctn=$ctn+1;
        }
        if($rectype==$trectype){
          $ctn=$ctn+1;
        }
        if($rocuniv==$trocuniv){
          $ctn=$ctn+1.5;
        }
      }
      $resultlist[$sinflat]=$ctn;

    }
  }
}

if($resultlist!=NULL){
  arsort($resultlist);
  reset($resultlist);
  $recoflat=key($resultlist);
}
$pdo=NULL;

 ?>


 <!DOCTYPE html>
 <html lang="en">
 <style>
         [v-cloak] {
                     display: none !important;
         }
 </style>
 <head>
     <div id = "head">
         <text id="logout"> Log out</text>
         <link  rel="stylesheet" type="text/css" href="../css/recommend.css">
         <script type="text/javascript" src="../js/addMsg.js"></script>
         <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
         <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
         <a href="tenantIndex.php"><button class="navigation" id="myBillboard" name="myBillboard">My Billboard</button></a>
         <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
         <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
         <a href="finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
     </div>
 </head>
 <body id="background">
 <div id="flatDiv">
     <label class="flats">
    <?php
     getrecommend("major",$flats,$flatNum);
     if($recoflat==NULL){
       echo"<p>no recommend flat for major yet</p>";
     }
     else{
       echo"Flat ".$recoflat;
       echo"<form action='recommend.php' method='post' name='recommendForm'><input type='hidden' name='inviteflat' value='".$recoflat."'/><button class='inviteBt' name='invite'>Invite</button></form>
       <br>
       <p class='reason'>Your have same majors</p>";
     }
      ?></label>

     <label class="flats">
       <?php
        getrecommend("university",$flats,$flatNum);
        if($recoflat==NULL){
          echo"<p>no recommend flat for university yet</p>";
        }
        else{
          echo"Flat ".$recoflat;
          echo"<button class='inviteBtn'>Invite</button>
           <br>
           <p class='reason'>You are in the same university</p>";
        }
         ?></label>
     <label class="flats">  <?php
        getrecommend("genderratio",$flats,$flatNum);
        if($recoflat==NULL){
          echo"<p>no recommend flat for male/female ratio yet</p>";
        }
        else{
          echo"Flat ".$recoflat;
          echo" <button class='inviteBtn'>Invite</button>
           <br>
           <p class='reason'>Male/female ratio is matched</p>";
        }
         ?></label>
 </div>
<script>
window.onload=function() {
    function fixRem() {
        var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
        var windowHeight = document.documentElement.clientHeight || window.innerHeight || document.body.clientHeight;
        // windowWidth = windowWidth > 750 ? 750 : windowWidth;
        var rootSize = 28 * (windowWidth / 375);
        var htmlNode = document.getElementsByTagName("html")[0];
        htmlNode.style.fontSize = rootSize + 'px';
    }
    fixRem();
    window.addEventListener('resize', fixRem, false);
}
</script>
 </body>
 </html>
