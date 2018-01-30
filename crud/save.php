

<?php

require_once 'koneksi.php';
$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$city 	  = $_POST["city"];
$status   = $_POST["status"];


$query = "INSERT INTO user (username, password, fullname, city, status)
VALUES (".$username.", ".$password.", ".$fullname.",".$city.",".$status.")";



$result = mysqli_query($con, $query);
$arr = array();
if ($result === TRUE) {
    echo '<script type="text/javascript">
           window.location = "http://localhost/crud"
      </script>';
} else {
    echo "Error save record: " ;
}
// Return json array containing data from the databasecon
 

?>