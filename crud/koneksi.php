<?php
$host="localhost";
$username='root';
$password='';

$con = mysqli_connect($host,$username,$password)or die ("Koneksi ke MYSQL gagal!");

$nama_database='crud';

mysqli_select_db($con, $nama_database) or die ("Koneksi ke database gagal");

?>
