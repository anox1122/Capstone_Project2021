<?php 
include('../functions1.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>

<head>

	<title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="../style_css43.css">
	<link rel="stylesheet" type="text/css" href="../table_css14.css">

	
</head>
<body>
	<div id="myNav" class="overlay">
		  <a href="javascript:void(0)" class="closebtn margin_btn" onclick="closeNav()">&times;</a>
		  <div class="overlay-content">
		  <a href="../admin/dashboard.php">Dashboard</a>
		  <a href="../admin/home.php">Appointment</a>
  </div>
</div>
<script>
function openNav() {
  document.getElementById("myNav").style.width = "25%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
</script>
	<table class="tableattrib2" border="0">
		<tr>
		<td class="td1">
		  <span onclick="openNav()">&#9776;</span>
	</td>
				<td class="profile_info">
		<img style="width:30px;height:30px;" src="../pics/admin.png">
	</td>
	<td class="td2">
	<div class="dropdown">
  <button class="dropbtn"><?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong><?php endif ?></button>
  <div class="dropdown-content1">
  <a href="create_user.php">Add User</a>
  <a href="home.php?logout='1'">Logout</a>
  </div>
</div>
	</td>
	<td></td><td></td><td></td>
	</tr>
	</table>
	<div class="container1">
	<div class="table">
		<div class="table-header1">
		<h3>Appointments</h3>
		</div>
		<hr class="horiline">
		</div>
	</div>
	<div class="container2">
      <input type="text" placeholder="Search.." name="search">
      <button class="searchbutton" type="submit"><i><img style="width:30px;height:28px;" src="../pics/search_icon.png"></i></button>
  	</div>
		<?php if (isset($_SESSION['success'])) : ?>
<?php endif ?>
	<?php 
		$dbhost='localhost';
	$dbuser='root';
	$dbpass='';
	$conn=mysqli_connect($dbhost, $dbuser, $dbpass);
	$sql='SELECT * FROM appointment';
	mysqli_select_db($conn, 'multi_login');
	$retval=mysqli_query($conn, $sql);

  	echo "<div class='container col-3 col-12'>
	
	<div class='table col-3 col-12'>
		<div class='table-header col-3 col-12'>
			<div class='header__item col-3 col-12'><a id='name' class='filter__link' href='#'>name</a></div>
			<div class='header__item col-3 col-12'><a id='wins' class='filter__link filter__link--number' href='#'>email</a></div>
			<div class='header__item col-3 col-12'><a id='draws' class='filter__link filter__link--number' href='#'>type</a></div>
			<div class='header__item col-3 col-12'><a id='losses' class='filter__link filter__link--number' href='#'>none</a></div>
			<div class='header__item col-3 col-12'><a id='total' class='filter__link filter__link--number' href='#'>none</a></div>
			<div class='header__item col-3 col-12'><a id='total' class='filter__link filter__link--number' href='#'>action</a></div>
		</div>";
  	$i = 0;
while($row=mysqli_fetch_array($retval, MYSQLI_NUM))
{
$i++;
echo"<script>
function myFunction() {
  var x = document.getElementById('li');
  if (x.className.indexOf('w3-show') == -1) {
    x.className += ' w3-show';
  } else { 
    x.className = x.className.replace(' w3-show', '');
  }
}
</script>";
	echo"<div class='table-table col-3 col-12'>	
			<div class='table-row col-3 col-12'>		
				<div class='table-data1 col-3 col-12'>{$row[3]}</div>
				<div class='table-data1 col-3 col-12'>{$row[4]}</div>
				<div class='table-data1 col-3 col-12'>{$row[5]}</div>
				<div class='table-data1 col-3 col-12'>{$row[6]}</div>
				<div class='table-data1 col-3 col-12'>{$row[7]}</div>
				<div class='table-data'>
				<div class='dropdown'>
				<button class='deletebtn' onclick='myFunction()'><img  src='../pics/3_dots_h.png' style='width:25px;height:6px;''></button>
				<div id='li' class='dropdown-content2'>
				<a href='../admin/dashboard.php'>Approved</a>
				<a href='../admin/home.php'>Delete</a>
				</div>
				</div>
				</div>
				</div>
				</div>
				";
				
}
echo "</div>";
?>
</body>
</html>