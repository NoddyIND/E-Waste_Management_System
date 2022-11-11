<?php
session_start();

include 'sqlconn.php';

$email = $_POST["email"];
$password = $_POST["password"];


$sql = "select * from facility";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['email'] == $email && $row['password'] == $password) {
        $_SESSION["loggedIn"] = true;
        $_SESSION["email"] = $email;
        echo "<script type='text/javascript'>
    alert('Login successful!');
    
 </script>";
        header("refresh:0.2;url=facility_dashboard.php");
        break;
    }else{
        $_SESSION["loggedIn"] = false;
        echo '<script>window.alert("Incorrect email Password"); 
        window.location = "facility_login.html";
         </script>';
        
    }
}

?>