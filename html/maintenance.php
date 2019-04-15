<?php
error_reporting(0);
include('connect.php');





?>



<!DOCTYPE html>
<html>
<head>
  <div id = "head">
    <text id="logout"> Log out</text>
    <link  rel="stylesheet" type="text/css" href="../css/maintenance.css">
    <script type="text/javascript" src="../js/maintenance.js"></script>
	  <a href="tenantIndex.html"><img id="logoSmall" src="../images/logo.png" alt="logo"></a>
	  <a href="tenantIndex.html" id="webName"><text id="title"> LivEasy </text></a>
	  <a href="maintenance.html"><button class="navigation" id="myMaintenance" name="myMaintenance">My Maintenance</button></a>
	  <a href="timetable.html"><button class="navigation" id="mySchedule" name="mySchedule">My Schedule</button></a>
	  <a><button class="navigation" id="myAccounting" name="myAccounting">My Accounting</button></a>
  </div>
</head>
<body id="background">
    <div id="body">
		<div class="maintenanceTable" style="overflow:scroll; overflow-x:hidden;">
			<table id = "maintTable" >
				<thead>
					<tr>
						<th>Facility</th>
						<th>Note</th>
						<th></th>
					</tr>
				</thead>
				<tr class="cell">
					<td class="facilityName">Bed light</td>
					<td class="note">Monday 9:00-13:00 available</td>
					<td class="finish"><button class="btn finishBtn" name="Finish Maintenance" onclick="setDisable(this)">Finish</button></td>
				</tr>
				<tr class="cell">
					<td class="facilityName">Cupboard handle</td>
					<td class="note">Any time</td>
					<td class="finish"><button class="btn finishBtn" name="Finish Maintenance" onclick="setDisable(this)">Finish</button></td>
				</tr>
			</table>
		</div>

		  <div class="text">
				<label for="facility">Facility</label>
				<input class="textInput" id="facility" type="text" name="facility" placeholder="Facility name where the issue is">
				<label for="note">Notes</label>
				<input class="textInput" id="note" type="text" name="note" placeholder="Available times, details etc">
				<button class="btn" id="addBtn" name="addBtn" onclick="checkNull()">Add</button>
		  </div>
</div>
</body>


</html>
