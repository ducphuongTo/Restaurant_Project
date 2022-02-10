
<?php

//start session

session_start();

//Create constants to store non repeating values
define('SITEURL', 'http://localhost:8080/Restaurant_Project/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
$db_select = mysqli_select_db($conn, DB_NAME);
//$res = mysqli_query($conn,$sql) or die(mysqli_error());
?>