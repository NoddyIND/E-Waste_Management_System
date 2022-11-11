<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}


include 'sqlconn.php';
$wid = $_POST["wid"];
$qty = $_POST["qty"];
$email = $_POST["useremail"];


$sql1 = "select * from user";
$result = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['email'] == $email) {
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
        break;
    }
}

$sql = "INSERT INTO pickup(email, wid, qty) VALUES ('$email',$wid,$qty)";
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