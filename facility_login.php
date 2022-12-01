<?php
session_start();

include 'sqlconn.php';

$email = $_POST["email"];
$password = $_POST["password"];


$sql = "select * from facility_center";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['email'] == $email && $row['password'] == $password) {
        $_SESSION["loggedIn"] = true;
        $_SESSION["email"] = $email;
        echo "<script type='text/javascript'>
    alert('Login successful!');
    window.location = 'facility_dashboard.php';
 </script>";
        break;
    }
}
if($_SESSION["loggedIn"] != true){
    $_SESSION["loggedIn"] = false;
echo '<script>window.alert("Incorrect email Password, email = '.$_POST["email"].', password = '.$_POST["password"].'");
        window.location = "facility_login.html";
        </script>';
}

?>