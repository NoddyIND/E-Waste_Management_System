<?php
include '../sqlconn.php';
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
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
	font-weight:30;
	color: white;
	margin: 0;
}

.backbtn{
	margin-left: 0px;
	width: 300px;
	margin-top: 30px;
}


.circle-wrap {
  margin-top: 70px;
  margin-left: 260px;
  width: 150px;
  height: 150px;
  background: #fefcff;
  border-radius: 50%;
  border: 1px solid #cdcbd0;
}
.circle-wrap .circle .mask,
.circle-wrap .circle .fill {
  width: 150px;
  height: 150px;
  position: absolute;
  border-radius: 50%;
}

.circle-wrap .circled .maskd,
.circle-wrap .circled .filld {
  width: 150px;
  height: 150px;
  position: absolute;
  border-radius: 50%;
}

.mask .fill {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #38e772;
}

.maskd .filld {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #38e772;
}
.circle-wrap .circle .mask {
  clip: rect(0px, 150px, 150px, 75px);
}

.circle-wrap .circled .maskd {
  clip: rect(0px, 150px, 150px, 75px);
}

.mask.full,
.circle .fill {
  animation: fill ease-in-out 3s;
  transform: rotate(var(--recy));
}

.maskd.fulld,
.circled .filld {
  animation: filld ease-in-out 3s;
  transform: rotate(var(--deco));
}

@keyframes fill{
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(var(--recy));
  }
}

@keyframes filld{
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(var(--deco));
  }
}
.circle-wrap .inside-circle {
  width: 122px;
  height: 122px;
  border-radius: 50%;
  background: #d2eaf1;
  line-height: 120px;
  text-align: center;
  margin-top: 14px;
  margin-left: 14px;
  color: #38e772;
  position: absolute;
  z-index: 100;
  font-weight: 700;
  font-size: 2em;
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
</style>
<body>
<button class="logout-btn" onclick="window.location.href='../logout.php'">Logout</button>
<div class="container" id="container">



<?php
$total = 0;
$locationQuery = "SELECT location FROM facility_center WHERE email = '".$_SESSION['email']."' ";
$querExec = mysqli_query($conn, $locationQuery);
$loc = mysqli_fetch_assoc($querExec);
echo "<h1 style='margin-top:30px ;'>".$loc['location']." Pickup Requests</h1>";
$sql = "SELECT s.qty, w.name, w.weight, s.cust_id, s.select_id FROM selects as s JOIN waste as w ON w.waste_id = s.waste_id JOIN customer as c ON c.cust_id = s.cust_id WHERE c.address = '".$loc['location']."' and s.schedule_id =0";
$result = mysqli_query($conn, $sql);

if(mysqli_fetch_assoc($result) == false)
{
    echo '<h3 style="margin-top:50px; ">No Requests available</h3>';
    
}
else{
    mysqli_free_result($result);
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $total = $total + ($row['weight']*$row['qty']);
  
    }
    $styleper = (((360/100) * $total)/2)."deg";
    echo "<script>
          document.documentElement.style.setProperty('--recy', '$styleper'); 
          </script>";
?>


<div class="recycle_round">
            <div class="circle-wrap">
              <div class="circle">
                <div class="mask half">
                  <div class="fill"></div>
                </div>
                <div class="mask full">
                  <div class="fill"></div>
                </div>
                <div class="inside-circle"> <?php if($result == true) 
                                                      echo $total;?>%</div>
              </div>
            </div>
          </div>

      
         

          <a class="btn btn-success btn-lg" href="pickup_req.php" role="button" style="margin-top: 30px;">Details</a><br>

          <a class ="btn btn-success btn-lg" href = "schedule_drive.php" role = "button" style = "margin-top: 30px;">Schedule drive</a><br>

        <?php

            }
            ?>


        
        <a class="btn btn-success btn-lg" href="../facility_dashboard.php" role="button" style="margin-top: 30px; margin-bottom:10px;">Back</a>

</div>
    

   

</body>
</html>