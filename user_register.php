<?php
include 'sqlconn.php';


$name = $_POST["name"];
$address = $_POST["address"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$password = $_POST["password"];


$sql1 = "select * from user";
$result = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['email'] == $email) {
        echo '<script>window.alert("Email id Already Exists!"); 
        window.location = "user_register.html";
         </script>';
    }
}
        

$sql = "INSERT INTO user(name, address, phone, email, password) VALUES ('$name', '$address', '$phone', '$email','$password')";
$run = mysqli_query($conn, $sql);
if ($run == true) {
    echo '<script type="text/javascript">
    alert("Registration done successfully!");
    window.location = "index.html";
 </script>';
} else {
    echo '<script> alert("Database Insertion error") </script>';
}
?>