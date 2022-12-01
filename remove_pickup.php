<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}
include 'sqlconn.php';
$id = $_GET["deleteid"];
$email = $_SESSION["email"];

$sql1 = "delete from selects where select_id = $id and schedule_id = 0;";
$result = mysqli_query($conn, $sql1);
if ($result == true) {
    echo "<script type='text/javascript'>
    alert('Pickup request Deleted successfully!');
    
 </script>";
 header( "refresh:0.2;url=pickup.php"); 
} else {
    echo '<script> alert("Error while Deleting") </script>';
}
?>