<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
}

include '../sqlconn.php';
$idQuery = "SELECT facility_id FROM facility_center WHERE email = '".$_SESSION['email']."' ";
			$querExec = mysqli_query($conn, $idQuery);
			$id = mysqli_fetch_assoc($querExec);


if(isset($_POST['select_driver'])){
    $scheduleQuery = "INSERT INTO schedule(drive_id, facility_id, schedule_date, start_time, finish_time) VALUES(".$_POST['select_driver'].",".$id['facility_id'].",'".$_POST['schedule_date']."','".$_POST['start_time']."','".$_POST['finish_time']."')";
    $run =  mysqli_query($conn, $scheduleQuery);
	
    if ($run == true) {
        echo "<script type='text/javascript'>
        alert('Drive Scheduled successfully!');
        
     </script>";
	 $sqlupdate = "Update drive set is_free = 1 where drive_id = ".$_POST['select_driver']."";
	$run1 = mysqli_query($conn, $sqlupdate);
	$sqlselect = "select schedule_id from schedule order by schedule_id desc limit 1";
	$run2 = mysqli_query($conn, $sqlselect);
	$row3 = mysqli_fetch_assoc($run2);
	$sqlupdateselects = "Update selects SET schedule_id = ".$row3['schedule_id']." WHERE facility_id = ".$id['facility_id']." and is_collected=0 and schedule_id = 0";
	$run3 = mysqli_query($conn, $sqlupdateselects);
    } else {
        echo '<script> alert("Error while inserting") </script>';
    
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}

body {
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
	
}

form {
	display: flex;
	align-items: left;
	flex-direction: column;
	padding: 0 50px;
	text-align: center;
}

.container {
	text-align: center;
	background-color: #fff;
	background: -webkit-linear-gradient(to right, #17bd4e, #38e772);
	background: linear-gradient(to right, #17bd4e, #38e772);
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	width: 700px;
	max-width: 100%;
	min-height: 480px;
}

.form-container {
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 100%;
	z-index: 2;
}

input {
	border-radius: 10px;
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

h1 {
	font-weight: bold;
	color: white;
	margin: 0;
}

.logout-btn{
	margin-top: 70px;
    margin-left: 70%;
	margin-bottom: 30px;
	width: 150px;
	border-radius: 10px;
	border: 0px solid;
	background-color: #17bd4e;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	height: 50px;
}
.logout-btn:hover{
	color: green;
  border: 1px solid #17bd4e;
	background-color: white;
}

.backbtn{
	margin-left: 0px;
	width: 300px;
	margin-top: 30px;
}
</style>
<body>
<button class="logout-btn" onclick="window.location.href='../logout.php'">Logout</button>
<div class="container" id="container">
	<br>
<form action="schedule_drive.php" method ="POST">
<select id="select_driver" name="select_driver" class="form-select form-select mb-3" aria-label=".form-select-lg example">
  <option selected>Select a Driver</option>
  <?php
            $sql = "SELECT drive_id FROM drive WHERE facility_id = ".$id['facility_id']." AND is_free=0";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' .$row["drive_id"].'">' .$row["drive_id"]. '</option>';
            }
          ?>
</select>

<label for="schedule_date">schedule date:</label>
<input data-provide="datepicker" type="date" id="schedule_date" name="schedule_date">

<label for="start_time">Select a start time:</label>
<input type="time" id="start_time" name="start_time">

<label for="finish_time">Select a finish time:</label>
<input type="time" id="finish_time" name="finish_time">

<input type="submit" class="btn btn-success btn-lg">
</form>

<a class="btn btn-success btn-lg" href="../facility_dashboard.php" role="button" style="margin-top: 30px; margin-bottom:10px;">Back</a>
</div>
    

   

</body>
</html>