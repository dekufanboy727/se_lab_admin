<?php

global $conn;

$host = "localhost";
$user = "root";
$pass = "";
$db = "se_lab";

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

?>