<?php


$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "ewaste_2";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>