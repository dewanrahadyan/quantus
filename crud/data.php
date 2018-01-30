<?php

require_once 'koneksi.php';

if(isset($_GET['username'])) {

$query = "SELECT * from user where username ='".$_GET['username']."'";	
}
else
{
$query = "SELECT * from user";	
}


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