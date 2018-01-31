<?php

require_once 'koneksi.php';
$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$city 	  = $_POST["city"];
$status   = $_POST["status"];



error_log($username);
$query = "UPDATE user SET password = '$password', fullname = '$fullname', city = '$city', status = '$status' WHERE username = '$username'";

//"UPDATE user SET password = '".$password."', fullname = '".$fullname."',  city = '".$city."', status = '".$status."', 
//WHERE username = '".$username."'";

//mysql_query("UPDATE user SET password = '$password', fullname = '$fullname', city = '$city', status = '$status' WHERE username = $username");

echo $query;
$result = mysqli_query($con, $query);
$arr = array();
if ($result === TRUE) {
     echo '<script type="text/javascript">
           window.location = "http://localhost/crud"
      </script>';
} else {
    echo "Error update record: " ;
}
// Return json array containing data from the databasecon
 

?>

