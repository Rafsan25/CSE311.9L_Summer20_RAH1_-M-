<?php
/*server with default (user 'root' with no password) */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mydb');

/*connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//echo ("Connected");

// Check connection
if($con == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
