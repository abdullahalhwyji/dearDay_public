<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dearDay";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

date_default_timezone_set('Asia/Jakarta');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>