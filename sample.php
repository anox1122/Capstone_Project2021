<html>
<?php 
include('functions1.php');

$username=date('Y-m-d');
// connect to database
$result = mysqli_query($db, "SELECT Count(prefered_date) AS value_sum FROM appointment WHERE prefered_date='$username'"); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
//cho"{$sum}";
$timestamp = strtotime('2021-11-07');

$day = date('D', $timestamp);
echo $day;
/*$date = date("l",time());
echo $date;*/
?>
</html>