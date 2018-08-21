<?php
$servername="ssael.co.in";
$user_name="ssael_analytics";
$password="Reset@123";
$dbname="ssael_analytics";
$conn=mysqli_connect($servername,$user_name,$password,$dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>