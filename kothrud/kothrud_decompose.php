<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
}

$id = $_GET['id'];
$email = $_GET['email'];

$updateQuery = "UPDATE pickup SET recycle_decompose = 2 where id = $id and email='$email' and is_collected = 1";
            if(mysqli_query($conn, $updateQuery)){
                header("refresh:0.2;url=kothrud_sort.php");
            }
            else{
                echo '<script>window.alert("Cannot Update");</script>';
            }
?>