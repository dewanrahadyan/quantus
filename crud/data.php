<?php

require_once 'koneksi.php';

$username = "";
$password = "";
$fullname= "";
$city= "";
$status= "";

if(isset($_GET['username'])) {
	$username = $_GET['username'];
}
if(isset($_GET['password'])) {
	$password = "and password = '".$_GET['password']."'";
}
if(isset($_GET['fullname'])) {
	$fullname = "and fullname like '%".$_GET['fullname']."%'";
}
if(isset($_GET['city'])) {
	$city = "and city like '%".$_GET['city']."%'";
}
if(isset($_GET['status'])) {
	$status = "and status like '%".$_GET['status']."%'";
}



$query = "SELECT * from user where username like '%".$username."%' ".$password." ".$fullname." ".$city." ".$status." ";
 


$result = mysqli_query($con, $query);
$arr = array();

if(mysqli_num_rows($result) != 0) {
while($row = mysqli_fetch_assoc($result)) {
$arr[] = $row;
}
}
// Return json array containing data from the databasecon
echo $json_info = json_encode($arr);
?>