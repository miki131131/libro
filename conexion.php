<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libro";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//var_dump($conn);
// Check connection
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>