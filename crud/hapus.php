<?php

require_once 'koneksi.php';
$username = $_GET["username"];
error_log($username);
$query = "delete from user where username = '".$username."'";
$result = mysqli_query($con, $query);
$arr = array();
if ($result === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " ;
}
// Return json array containing data from the databasecon
 

?>