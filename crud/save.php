

<?php
 

include "koneksi.php";
$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$city 	  = $_POST["city"];
$status   = $_POST["status"];

$sql="INSERT INTO user (username, password, fullname, city, status)
VALUES ('".$username."', '".$password."', '".$fullname."','".$city."','".$status."')";

$result = mysqli_query($con, $sql);


if($result) 
	{
		
		echo"<script>alert('New User succeesfully added')</script>";
		echo "
			<script type='text/javascript'>
			window.location = 'index.php'; 
			</script>";
	}
else
	{
		echo"<script>alert('New User unsuccesssfully added')</script>";	
	}

die(1);

?>