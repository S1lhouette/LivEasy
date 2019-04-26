<!DOCTYPE html>
<html lang="en">
<head>
    <div id = "head">
        <input type="submit" id="logout" value="Log out" onclick="return confirmLogout()">
        <link  rel="stylesheet" type="text/css" href="../css/topup.css">
        <script type="text/javascript" src="../js/topup.js"></script>
        <a href="tenantIndex.php"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
        <a href="tenantIndex.php" id="webName"><text id="title"> LivEasy </text></a>
        <a href="maintenance.php"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
        <a href="timetable.php"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
        <a href = "finance.php"><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
    </div>
</head>
<body id="background">
<div id="tinyTitle">Top-up to roommates</div>
<form id="topupForm" onsubmit="return myCheck()">
<table id="topupTable">
    <tr>
        <td><img src="../images/user.png"></td>
        <td><div class="userName">User A</div></td>
        <td><input type="text" class="topupInput" id="input1" onkeyup="checkNumber(this)"></td>

        <td><img src="../images/user.png"></td>
        <td><div class="userName">User A</div></td>
        <td><input type="text" class="topupInput" id="input2" onkeyup="checkNumber(this)"></td>

        <td><img src="../images/user.png"></td>
        <td><div class="userName">User A</div></td>
        <td><input type="text" class="topupInput" id="input3" onkeyup="checkNumber(this)"></td>
    </tr>
    <tr>
        <td><img src="../images/user.png"></td>
        <td><div class="userName">User A</div></td>
        <td><input type="text" class="topupInput" id="input4" onkeyup="checkNumber(this)"></td>

        <td><img src="../images/user.png"></td>
        <td><div class="userName">User A</div></td>
        <td><input type="text" class="topupInput" id="input5" onkeyup="checkNumber(this)"></td>

        <td><img src="../images/user.png"></td>
        <td><div class="userName">User A</div></td>
        <td><input type="text" class="topupInput" id="input6" onkeyup="checkNumber(this)"></td>
    </tr>
</table>
    <div id="hint"></div>
<input type="submit" id="submitBtn" value="Top-up">
</form>
</body>
</html>
