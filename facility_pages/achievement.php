<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
    
    
}
include '../sqlconn.php';
$email = $_SESSION["email"];

$id = "select facility_id from facility_center where email = '$email'";
$idresult = mysqli_query($conn, $id);

$rowid = mysqli_fetch_assoc($idresult);
$facility_id = $rowid["facility_id"];
$startdate = '2022-11-15';
$enddate='2022-11-18';
if(isset($_POST['end_date'])){
$enddate=$_POST['end_date'];
$startdate=$_POST['start_date'];
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
	max-height: auto;
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
	width: 40%;
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

.circle-wrap {
  margin-top: 20px;
  margin-left: 100px;
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



.mask .fill {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #38e772;
}


.circle-wrap .circle .mask {
  clip: rect(0px, 150px, 150px, 75px);
}


.mask.full,
.circle .fill {
  animation: fill ease-in-out 3s;
  transform: rotate(var(--recy));
}



@keyframes fill{
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(var(--recy));
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
</style>
<body>
<button class="logout-btn" onclick="window.location.href='../logout.php'">Logout</button>
<div class="container" id="container">
<h5 style="margin-top: 30px; color:white;">Select date</h5>
<form action="" method="post" style="display: block;">
<input type="date" name="start_date" id="start_date" value="<?php echo $startdate; ?>" onchange="this.form.submit()"> <span style="color:white; font-size:20px;">To</span>
<input type="date" name="end_date" id="end_date" value="<?php  echo $enddate; ?>" onchange="this.form.submit()">
</form>
<?php
$sqltotal = "select w.waste_id as waste_id, w.name as waste_name,s.qty, w.weight, rd.recycle_decompose, sch.schedule_date from waste as w join selects as s on s.waste_id = w.waste_id join recycle_decompose as rd on rd.select_id=s.select_id join schedule as sch on sch.schedule_id = s.schedule_id where sch.schedule_date between '$startdate' and '$enddate' and s.facility_id = $facility_id;";
$resulttotal = mysqli_query($conn, $sqltotal);
        if(mysqli_fetch_assoc($resulttotal) == true)
        {
            mysqli_free_result($resulttotal);
            $resulttotal = mysqli_query($conn, $sqltotal);
          $total = 0;
          while ($rowtotal = mysqli_fetch_assoc($resulttotal)) {
              
              $total = $total + ($rowtotal['weight']*$rowtotal['qty']);
  
          }
         
        }

        $sqlrecycle = "select w.waste_id as waste_id, w.name as waste_name,s.qty, w.weight, rd.recycle_decompose, sch.schedule_date from waste as w join selects as s on s.waste_id = w.waste_id join recycle_decompose as rd on rd.select_id=s.select_id join schedule as sch on sch.schedule_id = s.schedule_id where sch.schedule_date between '$startdate' and '$enddate' and s.facility_id = $facility_id and rd.recycle_decompose=1;";
        $resultrecycle = mysqli_query($conn, $sqlrecycle);
        if(mysqli_fetch_assoc($resultrecycle) == true)
        {
            mysqli_free_result($resultrecycle);
            $resultrecycle = mysqli_query($conn, $sqlrecycle);
          $recycle = 0;
          while ($rowrecycle = mysqli_fetch_assoc($resultrecycle)) {
              
              $recycle = $recycle + ($rowrecycle['weight']*$rowrecycle['qty']);
  
          }
          
        }
        $recy =round(($recycle / $total)* 100);
        $styleper = (((360/100) * $recy)/2)."deg";
        echo "<script>
        document.documentElement.style.setProperty('--recy', '$styleper'); 
              </script>";

?>


<h2 style="margin-top: 30px; color:white;"> Collected <b><?php echo $total; ?>kg</b> of e-waste till date.</h2>
<h3 style="color:white;">among which <b><?php echo $recycle; ?>kg</b> is Recycled.</h3>

<div class="recycle_round">
            
            <div class="circle-wrap" style="margin-left:270px;">
              <div class="circle" >
                <div class="mask half">
                  <div class="fill"></div>
                </div>
                <div class="mask full">
                  <div class="fill"></div>
                </div>
                <div class="inside-circle"> <?php echo $recy; ?>% </div>
        
              </div>
            </div>
            <h6 style="color: white;">Recycle percentage</h6>
          </div>
          <button style="margin-top: 20px;" onclick="window.location.href='achievement_details.php'; this.form.submit();" class="btn btn-success btn-lg">Details</button><br>
   
          <button style="margin-top: 20px; margin-bottom:20px;" onclick="window.location.href='../facility_dashboard.php'" class="btn btn-success btn-lg">Back</button>
          
</div>
    

   

</body>
</html>