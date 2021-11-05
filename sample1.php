<script src="js_function4.js"></script>
<?php include('functions1.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>Visitor's Form</title>
	<link rel="stylesheet" href="style_css42.css">
	<link rel="stylesheet" href="table_css11.css">
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
	<h2>Visitor's Form</h2>
</div>
<form method="post" action="grade_request.php">
	<?php echo display_error(); ?>

	<div class="input-group">
		<label>Name of Visitor</label>
		<input type="text" name="guardian">
	</div>
	<div class="input-group">
		<label>Name of Student</label>
		<input type="text" name="student">
	</div>


	<div class="table_center">
		<div>
				<label>Grade Level:</label>
		</div>
	<div>
				<?php 
					echo "<p>
					<select name='gradelvl_List' id='gradelvl_List'>
					<option value=''>---Selecta---</option>";
					$query = "SELECT * FROM grade_lvl";
					mysqli_select_db($conn, 'multi_login');	
					$retval=mysqli_query($conn, $query);
					$i = 0;
					while($value=mysqli_fetch_array($retval))
					{
					echo"<option value='{$value[1]}'>{$value[1]}</option>";
					$i++;
					}
					echo"</select>
					</p>";
				?>
			</div>
			</div>
		<div class="table_choices">
			<div class="tr_choices">
			<div class="td_choices">
				<label>Reason:</label>
			</div>
			<div class="td_choices">
			<?php 
				echo "<p>
				<select name='reason_type' id='reason_type'>
				<option value=''>--Select--</option>";
				$query = "SELECT * FROM reason_list";
				mysqli_select_db($conn, 'multi_login');	
				$retval=mysqli_query($conn, $query);
				$i = 0;
				while($value=mysqli_fetch_array($retval))
				{
				echo"<option value='{$value[1]}'>{$value[1]}</option>";
				$i++;
				}
				echo"</select>
				</p>";
				?>
			</div>
		</div>
	</div>
	<div class="table_choices">
		<div class="tr_choices">
			<div class="td_choices">
				<label>Prefered Date: </label>
			</div>
			<div class="td_choices">
				<input type="date" name="prefered_date">
			</div>		
		</div>
	</div>
	<div class="table_choices">
			<div class="tr_choices">
				<div class="td_choices">
					<label>Prefered Time:</label>
				</div>
			</div>
			<div class="tr_choices">
				<div class="td_choices">
					<?php 
						echo"<p>";
						$query = "SELECT * FROM time_choices";
						mysqli_select_db($conn, 'multi_login');	
						$retval=mysqli_query($conn, $query);
						$i = 0;
						while($value=mysqli_fetch_array($retval))
						{
						echo"<input type='radio' id='reason_type' name='reason_type' value='{$value[1]}'>
		  				<label for='{$value[1]}'>{$value[1]}</label><br>";
						$i++;
						}
						echo"</p>";
					?>
				</div>
			</div>
		</div>
	<div class="input-group">
		<button type="submit" class="btn" name="createappt_btn">submit</button>
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