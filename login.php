<?php include('functions1.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Miracle Christian Center Learning School</title>
	<link rel="stylesheet" type="text/css" href="style_css43.css">
</head>
<body class="">
	<table border="1" class="tableattrib1">
		
	</table>
	<div class="header">
		<h2>Login to your Account</h2>
	</div>
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<table class="tableattrib">
				<td>
			<button type="submit" class="btn" name="login_btn">Login</button>
				</td>
			</table>
		</div>
		<p>
			Not yet a member? <a href="register.php">Create Account</a>
		</p>
	</form>
</body>
</html>