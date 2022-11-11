<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
}



$sql = "select p.email, p.id, u.name, w.waste_type, p.qty from pickup as p join user as u on u.email = p.email join waste_types as w on w.waste_id = p.wid where u.address = 'Kothrud' and p.is_collected = 0";
$result = mysqli_query($conn, $sql);
$updateQuery = "UPDATE pickup join user on user.email = pickup.email SET is_collected = 1 where user.address='Kothrud'";
if(mysqli_query($conn, $updateQuery)){
    header("refresh:0.2;url=kothrud_pickup_req_data.php");
}
else{
    echo '<script>window.alert("Cannot Update");</script>';
}

?>

