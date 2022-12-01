<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}


include 'sqlconn.php';
$wid = $_POST["select_state"];
$qty = $_POST["qty"];
$custid = $_SESSION["id"];


$sql1 = "SELECT address as location FROM customer WHERE email = '".$_SESSION['email']."'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT facility_id FROM facility_center WHERE location = '".$row['location']."'";
$result = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result);
$sql = "INSERT INTO selects(cust_id, waste_id, qty, req_date, facility_id) VALUES ($custid,$wid,$qty, now(),".$row['facility_id'].");";
$run = mysqli_query($conn, $sql);
if ($run == true) {
    echo "<script type='text/javascript'>
    alert('Pickup requested successfully!');
    
 </script>";
 header( "refresh:0.2;url=pickup.php"); 
} else {
    echo '<script> alert("Error while inserting") </script>';

}


?>