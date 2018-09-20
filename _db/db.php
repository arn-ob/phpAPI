
<?php

// header_remove('Access-Control-Allow-Origin');
// header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");


/* server timezone */
date_default_timezone_set("Asia/Dhaka");

// header_remove('Access-Control-Allow-Origin');
// header('Access-Control-Allow-Origin: *');

// change the access info while in install at server

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";  

$conn = new mysqli($servername, $username, $password, $dbname);

?>