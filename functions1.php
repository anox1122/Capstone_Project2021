<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'multi_login');
$conn = mysqli_connect('localhost', 'root', '',);
// variable declaration
$username = "";
$email    = "";
$reason_type = "";
$fullname = "";
$contact_ = "";
$date = date('Y-m-d H:i:s');
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $conn, $errors, $username, $email, $date;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
    $fullname    =  e($_POST['fullname']);
    $email       =  e($_POST['email']);
    $contact_    =  e($_POST['contact_']);
	$username    =  e($_POST['username']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($fullname)) { 
		array_push($errors, "Full Name is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($contact_)) { 
		array_push($errors, "Contact is required"); 
	}
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$date_created = $date;
		$password = md5($password_1);//encrypt the password before saving in the database
		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (fullname, email, contact_, username, date_created, user_type, password) 
					  VALUES('$fullname', '$email', '$contact_', '$username', '$date_created', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (fullname, email, contact_, username, date_created, user_type, password) 
					  VALUES('$fullname', '$email', '$contact_', '$username', '$date_created', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: login.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
// ...
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
// call the createAppt() function if createappt_btn is clicked
if (isset($_POST['createappt_btn'])) {
	createAppt();
}
// call the createAppt() function if createappt_btn is clicked
/*if (isset($_POST['meetingrq_btn'])) {
	createAppt();
}*/

// CREATE APPOINTMENT: GRADE REQUEST FORM
function createAppt(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $reason_type;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$guardian = e($_POST['guardian']);
	$student = e($_POST['student']);
	$gradelvl_List = e($_POST['gradelvl_List']);
	$reason_type = e($_POST['reason_type']);
	$prefered_date  =  e($_POST["prefered_date"]);
	$prefered_time  =  e($_POST["prefered_time"]);
	//date_created_appointment(lalagay ko bukas)
	$current_date = date('Y-m-d');
	$valid_date =  strtotime(e($_POST["prefered_date"]));
	$day = date('D', $valid_date);

	//magquery para makuha ung count ng date and time
	//$count_time = mysqli_query($db, "SELECT Count(prefered_time) AS time_sum FROM appointment WHERE prefered_date='$prefered_date'");
	//$row_time = mysqli_fetch_assoc($count_time); 
	//$time_add = $row_time['time_sum'];
	//pwede dito ung date/time limitation
	//need to pag bibilangin na ung time
	$morning = mysqli_query($db, "SELECT * time_list FROM time_choices WHERE time_list='$prefered_time'");
	$count_datem = mysqli_query($db, "SELECT Count(prefered_date) AS date_summ FROM appointment WHERE (prefered_time='$prefered_time') AND (prefered_date='$prefered_date')");
	$row_datem = mysqli_fetch_assoc($count_datem); 
	$date_addmorning = $row_datem['date_summ'];

	/*$afternoon = mysqli_query($db, "SELECT * time_list FROM time_choices WHERE time_list='$prefered_time'");*/
	$count_datea = mysqli_query($db, "SELECT Count(prefered_date) AS date_suma FROM appointment WHERE prefered_time='$prefered_time' AND (prefered_date='$prefered_date')");
	$row_datea = mysqli_fetch_assoc($count_datea); 
	$date_addafternoon = $row_datea['date_suma'];

	$date_add = $date_addafternoon + $date_addmorning;
	// form validation: ensure that the form is correctly filled
	if (empty($guardian)) { 
		array_push($errors, "Visitor's Name is required"); 
	}
	if (empty($student)) { 
		array_push($errors, "Student's Name is required"); 
	}
	if (empty($gradelvl_List)) { 
		array_push($errors, "Grade Level is required"); 
	}
	if (empty($reason_type)) { 
		array_push($errors, "This section is required"); 
	}
	if (empty($prefered_date)) { 
		array_push($errors, "Date is required"); 
	}
	if (empty($prefered_time)) { 
		array_push($errors, "Time is required"); 
	}
	if ($date_addmorning == 5 ||$date_addafternoon == 5) { 
		array_push($errors, "Slot is full please choose another time"); 
	}
	if ($date_add == 10) { 
		array_push($errors, "Slot is full please choose another date"); 
	}
	if($prefered_date <= $current_date){
		array_push($errors, "Please choose another date bobo"); 
	}
	if($day == 'Sat' || $day == 'Sun'){
		array_push($errors, "No transaction from Sat-Sun"); 
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) 
	{
			//if($date_add < 10){
		$id = ($_SESSION['user']['id']);
		$user_name = ($_SESSION['user']['username']);
		$dateapp_created = "SELECT CURRENT_TIMESTAMP";
			$query = "INSERT INTO appointment (id, username, guardian, student, gradelvl_List, reason_type, prefered_date, prefered_time, status, dateapp_created, total) 
					  VALUES('$id', '$user_name', '$guardian', '$student', '$gradelvl_List',  '$reason_type', '$prefered_date', '$prefered_time', 'Pending', '$dateapp_created', '$date_addafternoon')";
			mysqli_query($db, $query);
		//}
	}
	}
/* value="<?php echo $guardian; ?>"
 value="<?php echo $student; ?>"
 value="<?php echo $lrn; ?>"
 value="<?php echo $prefered_date; ?>"
 value="<?php echo $prefered_time; ?>"*/
/**/
/*function reasonList(){
			echo "Choose :  
            <select Emp Name='NEW'>  
            <option value=''>--- Select ---</option>";
	global $db, $errors, $username, $email;
	if (isset ($select)&&$select!=''){  
                $select=$_POST ['NEW'];
            }
            $list=mysql_query("select * from reason_list order by reason_id asc");  
            while($row_list=mysql_fetch_assoc($list)){
            	echo"<option value='{$row_list['emp_id']}";
            	if($row_list['emp_id']==$select){ echo 'selected'; }
            	$row_list['emp_name'];
            	echo"</option>";}
            	echo"</select>"; 
}*/
/*else{
					array_push($errors, "Choose another date");
				}
			}else{
				array_push($errors, "Choose another time"); 
			}*/