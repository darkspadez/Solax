<?php
$host = "localhost"; // Your database host usually localhost
$db = ""; // Your database name
$dbuser = ""; // Your database user
$dbpass = ""; // Your database password
$mysqli_open = mysqli_connect($host,$dbuser,$dbpass) or die(mysqli_error());
mysqli_select_db($db) or die(mysqli_error());
?>