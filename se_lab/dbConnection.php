<?php
error_reporting(0); //set this to 0 if it's finished or else there's going to be problems
global $conn;

$host = "localhost";
$user = "root";
$pass = "";
$db = "se_lab";

$conn = new mysqli($host, $user, $pass, $db);
if(!$conn){
    die("connection failed: " . mysqli_connect_error());
    mysqli_close($conn);
}

?>