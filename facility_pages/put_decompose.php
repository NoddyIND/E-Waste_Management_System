<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
}

$id = $_GET['id'];

$updateQuery = "INSERT INTO recycle_decompose(select_id, recycle_decompose) VALUES($id, 2)";
            if(mysqli_query($conn, $updateQuery)){
                header("refresh:0.2;url=sort.php");
            }
            else{
                echo '<script>window.alert("Cannot Update");</script>';
            }
?>