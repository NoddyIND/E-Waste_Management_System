<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
}

$id = $_GET['id'];

$locationQuery = "SELECT facility_id FROM facility_center WHERE email = '".$_SESSION['email']."' ";
$querExec = mysqli_query($conn, $locationQuery);
$loc = mysqli_fetch_assoc($querExec);
$driveQuery = "SELECT drive_id FROM drive WHERE is_collected = 0 AND facility_id = ".$loc['facility_id']."";
$driveQueryExec = mysqli_query($conn, $driveQuery);
$drive_id = mysqli_fetch_assoc($driveQueryExec);
$updateQuery = "UPDATE selects SET drive_id = ".$drive_id['drive_id']." where select_id = $id";


            if(mysqli_query($conn, $updateQuery)){
                header("refresh:0.2;url=pickup_req.php");
            }
            else{
                echo '<script>window.alert("Cannot Update");</script>';
            }
?>