<?php
//start session

//create constants
define('SITEURL', 'http://localhost/primelibrary/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'primelibrary');
$con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($con)); //database connection
$db_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));