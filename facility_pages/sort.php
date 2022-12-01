<?php
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

/* button {
	margin-left: 150px;
	width: 50%;
	border-radius: 10px;
	border: 0px solid;
	background-color: #17bd4e;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
	height: 50px;
}
button:hover{
	color: green;
  border: 1px solid #17bd4e;
	background-color: white;
} */

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
</style>
<body>
<button class="logout-btn" onclick="window.location.href='../admin_logout.php'">Logout</button>
<div class="container" id="container">

<h1 style="margin-top:30px ;">Kothrud Pickup Requests</h1>

<?php
include '../sqlconn.php';
$locationQuery = "SELECT facility_id FROM facility_center WHERE email = '".$_SESSION['email']."' ";
$querExec = mysqli_query($conn, $locationQuery);
$loc = mysqli_fetch_assoc($querExec);
$sql = "SELECT * FROM selects WHERE facility_id = ".$loc['facility_id']."";
$result = mysqli_query($conn, $sql);
if(mysqli_fetch_assoc($result) == false)
{
    echo '<h3 style="margin-top:50px; "> Nothing to Display</h3>';
}
else{
    ?>

<table class="table table-bordered table-hover" style="margin-top: 50px;">
            <thead>
                <tr>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Waste</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Recycle</th>
					<th scope="col">Decompose</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
			$sql = "SELECT s.qty, w.name, w.weight, s.select_id, c.cust_name FROM selects AS s JOIN customer as c on s.cust_id = c.cust_id JOIN waste as w ON w.waste_id = s.waste_id WHERE s.schedule_id != 0 AND s.is_collected = 1 AND s.select_id NOT IN (SELECT select_id FROM recycle_decompose);
			";
			$result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                  
                  echo '<tr><td>' . $row["cust_name"] . '</td><td>' . $row['name'] .'</td><td>'.$row['qty'] .'</td><td><a class="btn btn-success" href="put_recycle.php?id='.$row["select_id"].'" role="button">Recycle</a></td></td><td><a class="btn btn-success" href="put_decompose.php?id='.$row["select_id"].'" role="button">Decompose</a></td>';
              }

              ?>
            </tbody>
        </table>

        <?php
        }
        ?>

        <a class="btn btn-success btn-lg" href="../facility_dashboard.php" role="button" style="margin-top: 50px; margin-bottom:10px;">Back</a>

</div>
    

   

</body>
</html>