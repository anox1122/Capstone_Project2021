<script src="js_function5.js"></script>
<?php include('functions1.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>LRN Request Form</title>
	<link rel="stylesheet" href="style_css43.css">
	<link rel="stylesheet" href="table_css14.css">
</head>
<body>
	<div id="myNav" class="overlay">
		  <button class="btn"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></button>
		  <div class="overlay-content">
		  	<a href="index.php">Appointments</a>
		 	 <a href="account_user.php">Manage Account</a>
  </div>
	</div>
	<table class="tableattrib2" border="0">
		<tr>
		<td class="td1">
		  <span onclick="openNav()">&#9776;</span>
	</td>
				<td class="profile_info">
		<img style="width:30px;height:30px;" src="pics/admin.png">
	</td>
	<td class="td2">
	<div class="dropdown">
  <button class="dropbtn"><?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong><?php endif ?></button>
  <div class="dropdown-content1">
  <a href="index.php?logout='1'">Logout</a>
  </div>
</div>
	</td>
	<td></td><td></td><td></td>
	</tr>
	</table>
<div class="header">
	<h2>LRN Request Form</h2>
</div>
<form method="post" action="lrn_request.php">
	<?php echo display_error(); ?>

	<div class="input-group">
		<label>Name of Guardian</label>
		<input type="text" name="guardian">
	</div>
	<div class="input-group">
		<label>Name of Student</label>
		<input type="text" name="student">
	</div>
	<div class="input-group">
		<label>LRN</label>
		<input type="text" name="lrn">
	</div>
	<div class="">
		<label>Choose prefered date:</label>
		<input type="date" name="prefered_date">
	</div>
	<div class="">
		<label>Choose prefered time: </label>
  		<input type="time" name="prefered_time">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="meetingrq_btn">Submit</button>
	</div>
</form>
<div id="create" class="overlay">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<div class="tableattrib1 btn_reason">
		<div class="table-row1">
			<div class="table-data1">
			<a href="grade_request.php"><button class="reason_btn zoom"><h1 class="text">Form 137</h1><img class="reason_pic resize" src="pics/grade_art.png"></button></a>
			</div>
			<div class="table-data1">
			<a href="lrn_request.php"><button class="reason_btn zoom"><h1 class="text">LRN</h1><img class="reason_pic resize" src="pics/lrn_art.png"></button></a>
			</div>
		</div>
	</div>
</div>
	<p class="text">
		Not what you are looking for? <button onclick="createApp()" class="back_reason" name="back_reason_btn">Click here</button>
	</p>
</body>
</html>