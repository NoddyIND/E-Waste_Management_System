<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}
include 'sqlconn.php';

$email = $_SESSION["email"];
$wid = $_POST["wid"];
$qty = $_POST["qty"];
$id = $_POST["id"];




$sql1 = "update pickup set wid = $wid, qty = $qty where id=$id and email = '$email'";
$result = mysqli_query($conn, $sql1);
if ($result == true) {
    echo "<script type='text/javascript'>
    alert('Pickup request Updated successfully!');
    
 </script>";
 header( "refresh:0.2;url=pickup.php"); 
} else {
    echo '<script> alert("Error while Updating") </script>';
}
?>