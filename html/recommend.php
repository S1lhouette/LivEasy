<?php
//error_reporting(0);
include('Validaccess.php');
include('connect.php');
$flatNum=$_SESSION['flatNum'];
$userId=$_SESSION['userID'];
$major=array();
$type=array();
$university=array();
$gender=array();
  $recomajor=NULL;
  $rocuniv=NULL;
  $rectype=NULL;
  $genderratio=NULL;

if(isset($_POST['invite'])){
  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
  $invitecontent="*Flat".$flatNum."invites you to be their friends.";
  $stmt=$pdo->query("insert into messagetable values(default,\"{$userId}\",\"{$invitecontent}\",default,\"{$_POST['Daily']}\",0)");
  $pdo=NULL;
}

$pdo=new PDO($dsn,$db_username,$db_password,$opt);

  foreach($pdo->query("select * from messagetable natural join usertable where usertable.flatNum=\"{$flatNum}\"") as $row){
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
  $recomajor=array_search(max(array_count_values($major)),array_count_values($major));
  $rocuniv=array_search(max(array_count_values($university)),array_count_values($university));
  $rectype=array_search(max(array_count_values($type)),array_count_values($type));
  $genderratio=$male/count($gender);



$flats=array();
foreach($pdo->query("select * from messagetable natural join usertable")as $row){
  $flats[]=$row['flatNum'];
}

$resultlist=array();
$recoflat=NULL;
$pdo=NULL;



function getrecommend($type,$flats,$flatNum,$recomajor,$rocuniv,$rectype,$genderratio){//调用改函数即 获得推荐宿舍
  include('connect.php');
  global $htmlctnm,$htmlctngen,$htmlctnuni;
  $htmlctnm=$htmlctngen=$htmlctnuni=5;
  $pdo=new PDO($dsn,$db_username,$db_password,$opt);
  foreach(array_keys(array_count_values($flats)) as $sinflat){
    if($sinflat!=$flatNum && $sinflat!=0){
      $ctn=0;
      $thismajor=array();
      $thistype=array();
      $thisuniversity=array();
      $thisgender=array();
      foreach($pdo->query("select * from messagetable natural join usertable where usertable.flatNum=\"{$sinflat}\"") as $row){
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

      $trecomajor=array_search(max(array_count_values($thismajor)),array_count_values($thismajor));
      $trocuniv=array_search(max(array_count_values($thisuniversity)),array_count_values($thisuniversity));
      $trectype=array_search(max(array_count_values($thistype)),array_count_values($thistype));
      $tgenderratio=$male/count($thisgender);
      if(strcmp($type,"genderratio")==0){
        if(abs($genderratio-$tgenderratio)<=0.2){
          $ctn=$ctn+1.5;
          $htmlctngen=$htmlctngen+15;
        }
        if(strcmp($recomajor,$trecomajor)==0){
          $ctn=$ctn+1;
          $htmlctnm=$htmlctnm+10;
        }
        if(strcmp($rectype,$trectype)==0){
          $ctn=$ctn+1;
        }
        if(strcmp($rocuniv,$trocuniv)==0){
          $ctn=$ctn+1;
          $htmlctnuni=$htmlctnuni+10;
        }
      }else if(strcmp($type,"major")==0){
        if(abs($genderratio-$tgenderratio)<=0.2){
          $ctn=$ctn+1;
            $htmlctngen=$htmlctngen+10;
        }
        if(strcmp($recomajor,$trecomajor)==0){
          $ctn=$ctn+1.5;
          $htmlctnm=$htmlctnm+15;
        }
        if(strcmp($rectype,$trectype)==0){
          $ctn=$ctn+1;
        }
        if(strcmp($rocuniv,$trocuniv)==0){
          $ctn=$ctn+1;
            $htmlctnuni=$htmlctnuni+10;
        }
      }else if(strcmp($type,"university")==0){
        if(abs($genderratio-$tgenderratio)<=0.2){
          $ctn=$ctn+1;
            $htmlctngen=$htmlctngen+10;
        }
        if(strcmp($recomajor,$trecomajor)==0){
          $ctn=$ctn+1;
            $htmlctnm=$htmlctnm+10;
        }
        if(strcmp($rectype,$trectype)==0){
          $ctn=$ctn+1;
        }
        if(strcmp($rocuniv,$trocuniv)==0){
          $ctn=$ctn+1.5;
            $htmlctnuni=$htmlctnuni+15;
        }
      }
      $resultlist[$sinflat]=$ctn;
    }
  }

$pdo=NULL;
if(count($resultlist)>0){
  arsort($resultlist);
  reset($resultlist);
  $recoflat=key($resultlist);
  echo"Flat ".$recoflat;
  echo"<form action='recommend.php' method='post' name='recommendForm'><input type='hidden' name='inviteflat' value='".$recoflat."'/><button class='inviteBtn' name='invite'>Invite</button></form>";
  if(strcmp($type,"major")==0){
    echo"<p class='reason'>Major is matched.</p>";
  }elseif (strcmp($type,"university")==0) {
    echo"<p class='reason'>University is matched.</p>";
  }elseif(strcmp($type,"genderratio")==0){
  echo"<p class='reason'>Gender ratio is matched.</p>";
  }// 请修改此处的html代码，让invite 按钮在flat右边，切勿删除form，否则后端无法向对方宿舍放松信息
}else{
  echo"<p>no recommend flat for ".$type." yet</p>";
}
}




 ?>


 <!DOCTYPE html>
 <html>
 <style>
         [v-cloak] {
                     display: none !important;
         }
 </style>
 <head>
     <div id = "head">
         <text id="logout"> Log out</text>
         <link  rel="stylesheet" type="text/css" href="../css/recommend.css">
         <script type="text/javascript" src="../js/recommend.js"></script>
         <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
         <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
         <a href="tenantIndex.php"><button class="navigation" id="myBillboard" name="myBillboard">My Billboard</button></a>
         <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
         <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
         <a href="finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
     </div>
 </head>
 <body id="background">
   <!-- <div height="400" width="600" style="margin:50px">
       	<canvas id="chart"> 你的浏览器不支持HTML5 canvas </canvas>
   	</div> -->
 <div id="flatDiv">

  <div class="flats">
       <div class="chart">
         <canvas id="chart1"> Sorry, your browser does not support HTML5 canvas </canvas>
       </div>
       <div class="description">
          <?php
           getrecommend("major",$flats,$flatNum,$recomajor,$rocuniv,$rectype,$genderratio);
             ?>
          <input type="hidden" id='ctnformj1' value="<?php echo $htmlctnm; ?>" />
          <input type="hidden" id='ctnforuni1' value="<?php echo $htmlctnuni; ?>" />
          <input type="hidden" id='ctnforgen1' value="<?php echo $htmlctngen; ?>" />
          <script>
          var gmaj=parseInt(document.getElementById("ctnformj1").value);
          var guni=parseInt(document.getElementById("ctnforuni1").value);
          var ggender=parseInt(document.getElementById("ctnforgen1").value);
          goChart([[gmaj,'#fd5259','Major'], [guni,'#fdeb65', 'University'], [ggender,'#ade9ff','Gender ratio']],"chart1");</script>
      </div>
  </div>

  <div class="flats">
       <div class="chart">
         <canvas id="chart2"> Sorry, your browser does not support HTML5 canvas </canvas>
       </div>
       <div class="description">
       <?php
        getrecommend("university",$flats,$flatNum,$recomajor,$rocuniv,$rectype,$genderratio);
         ?>  <input type="hidden" id='ctnformj2' value="<?php echo $htmlctnm; ?>" />
           <input type="hidden" id='ctnforuni2' value="<?php echo $htmlctnuni; ?>" />
           <input type="hidden" id='ctnforgen2' value="<?php echo $htmlctngen; ?>" />
           <script>
           var gmaj=parseInt(document.getElementById("ctnformj2").value);
           var guni=parseInt(document.getElementById("ctnforuni2").value);
           var ggender=parseInt(document.getElementById("ctnforgen2").value);
           goChart([[gmaj,'#fd5259','Major'], [guni,'#fdeb65', 'University'], [ggender,'#ade9ff','Gender ratio']],"chart2");</script>
      </div>
  </div>

  <div class="flats">
       <div class="chart">
         <canvas id="chart3"> Sorry, your browser does not support HTML5 canvas </canvas>
       </div>
       <div class="description">
         <?php
          getrecommend("genderratio",$flats,$flatNum,$recomajor,$rocuniv,$rectype,$genderratio);
           ?>  <input type="hidden" id='ctnformj3' value="<?php echo $htmlctnm; ?>" />
             <input type="hidden" id='ctnforuni3' value="<?php echo $htmlctnuni; ?>" />
             <input  type="hidden" id='ctnforgen3' value="<?php echo $htmlctngen; ?>" />
             <script>
             var gmaj=parseInt(document.getElementById("ctnformj3").value);
             var guni=parseInt(document.getElementById("ctnforuni3").value);
             var ggender=parseInt(document.getElementById("ctnforgen3").value);
           goChart([[gmaj,'#fd5259','Major'], [guni,'#fdeb65', 'University'], [ggender,'#ade9ff','Gender ratio']],"chart3");</script>
      </div>
  </div>




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
