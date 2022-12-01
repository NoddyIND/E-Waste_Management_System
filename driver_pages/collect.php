<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: driver_login.php");
}
$email = $_SESSION["email"];
$id = $_GET['id'];


$selectq = "select sch.schedule_id from schedule as sch join drive as d on sch.drive_id = d.drive_id where d.email = '$email' and sch.is_completed=0; ";
$exeq = mysqli_query($conn, $selectq);
$schid = mysqli_fetch_assoc($exeq);
$updateQuery = "UPDATE selects SET is_collected = 1 WHERE select_id = $id";
            if(mysqli_query($conn, $updateQuery)){
                $check = "select is_collected from selects as s join schedule as sch on s.schedule_id = sch.schedule_id where s.is_collected=0 and sch.schedule_id = ".$schid['schedule_id']."; ";
                $execheck = mysqli_query($conn, $check);
                if(mysqli_fetch_assoc($execheck) == false)
                {
                    $upquery = "update schedule set is_completed = 1 where schedule_id = ".$schid['schedule_id'].";";
                    mysqli_query($conn, $upquery);
                    $selectdriveid = "select d.drive_id from drive as d join schedule as sch on d.drive_id = sch.drive_id where sch.schedule_id=".$schid['schedule_id'].";";
                    $exeselectdriveid = mysqli_query($conn, $selectdriveid);
                    $fetchdriveid = mysqli_fetch_assoc($exeselectdriveid);
                    $updatedrive = "update drive set is_free=0 where drive_id = ".$fetchdriveid['drive_id'].";";
                    mysqli_query($conn, $updatedrive);
                    
                }
                header("refresh:0.2;url=driver_dashboard.php");
            }
            else{
                echo '<script>window.alert("Cannot Update");</script>';
            }
?>