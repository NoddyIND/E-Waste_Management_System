<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
    
    
}
include '../sqlconn.php';
$id = $_POST['id'];
$schedule_date = $_POST['schedule_date'];
$start_time = $_POST['start_time'];
$finish_time = $_POST['finish_time'];

$sql = "update schedule set schedule_date = '$schedule_date', start_time= '$start_time', finish_time = '$finish_time' where schedule_id = $id";
$result = mysqli_query($conn, $sql);
if($result == true)
{
    echo "<script type='text/javascript'>
    alert('Schedule Updated successfully!');
    
 </script>";
 header( "refresh:0.2;url=show_drive_status.php");
}



?>