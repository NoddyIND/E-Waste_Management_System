<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
}

$id = $_GET['id'];
$email = $_GET['email'];

$updateQuery = "UPDATE pickup SET is_collected = 1 where id = $id and email='$email'";
            if(mysqli_query($conn, $updateQuery)){
                header("refresh:0.2;url=kothrud_pickup_req.php");
            }
            else{
                echo '<script>window.alert("Cannot Update");</script>';
            }
?>