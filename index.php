<script src="js_function5.js"></script>
<?php 
	include('functions1.php');
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>

<!DOCTYPE html>
<html>

<head>

	<title>User Page</title>
	<link rel="stylesheet" type="text/css" href="style_css43.css">
	<link rel="stylesheet" type="text/css" href="table_css14.css">

	
</head>
<body class="">
	<div id="myNav" class="overlay">
<button><a href="javascript:void(0)" class="closebtn margin_btn" onclick="closeNav()">&times;</a></button>
		  <div class="overlay-content">
		  	<a href="index.php">Appointment</a>
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
	<div class="container1">
	<div class="table">
		<div class="table-header1">
		<h3>My Appointments</h3>
		</div>
		<hr class="horiline">
		</div>
	</div>
	<div class="container2">
      <input type="text" placeholder="Search.." name="search">
      <button class="searchbutton" type="submit"><i><img style="width:30px;height:28px;" src="pics/search_icon.png"></i></button>
  	</div>
		<?php if (isset($_SESSION['success'])) : ?>
<?php endif ?>
	<?php
	$dbhost='localhost';
	$dbuser='root';
	$dbpass='';
	$id =  $_SESSION['user']['id'];
	$conn=mysqli_connect($dbhost, $dbuser, $dbpass);
	$sql="SELECT * FROM appointment where id=$id";
	mysqli_select_db($conn, 'multi_login');
	$retval=mysqli_query($conn, $sql);

  	echo "<div class='container col-3 col-12'>
	
	<div class='table col-3 col-12'>
		<div class='table-header col-3 col-12'>
			<div class='header__item col-3 col-12'><a id='name' class='filter__link' href='#'>Guardian</a></div>
			<div class='header__item col-3 col-12'><a id='wins' class='filter__link filter__link--number' href='#'>Student</a></div>
			<div class='header__item col-3 col-12'><a id='draws' class='filter__link filter__link--number' href='#'>Type</a></div>
			<div class='header__item col-3 col-12'><a id='losses' class='filter__link filter__link--number' href='#'>Prefered Date</a></div>
			<div class='header__item col-3 col-12'><a id='total' class='filter__link filter__link--number' href='#'>Preered Time</a></div>
			<div class='header__item col-3 col-12'><a id='total' class='filter__link filter__link--number' href='#'>Status</a></div>
			<div class='header__item col-3 col-12'><a id='total' class='filter__link filter__link--number' href='#'>action</a></div>
		</div>";
  	$i = 0;

while($row=mysqli_fetch_array($retval, MYSQLI_NUM))
{

$i++;
	echo"<div class='table-table col-3 col-12'>	
			<div class='table-row col-3 col-12'>		
				<div class='table-data1 col-3 col-12'>{$row[3]}</div>
				<div class='table-data1 col-3 col-12'>{$row[4]}</div>
				<div class='table-data1 col-3 col-12'>{$row[6]}</div>
				<div class='table-data1 col-3 col-12'>{$row[7]}</div>
				<div class='table-data1 col-3 col-12'>{$row[8]}</div>
				<div class='table-data1 col-3 col-12'>{$row[9]}</div>
				<div class='table-data'>
				<div class='dropdown'>
					  	<script>function dropdownFunction() {
  var x = document.getElementById('$row[0]');
  if (x.className.indexOf('w3-show') == -1) {
    x.className += ' w3-show';
  } else { 
    x.className = x.className.replace(' w3-show', '');
  }
}</script>
				<button class='deletebtn' onclick='dropdownFunction()'>&hellip;</button>
				<div id='$row[0]' class='dropdown-content2'>
				<a href='admin/dashboard.php'>Approved</a>
				<a href='admin/home.php'>Delete</a>
				</div>
				</div>
				</div>
				</div>
				</div>
				";
				
}
?>
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
	
		<div class="tableattrib3">
		<button onclick="createApp()" class="btn" name="create_app_btn">Create</button>
		</div>
</body>
</html>