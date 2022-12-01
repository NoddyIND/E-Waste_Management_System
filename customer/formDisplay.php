<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: facility_login.html");
    
}
include '../sqlconn.php';
    $email = $_SESSION["email"];
    $custid = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<title>Document</title>
</head>
<style>
   @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
      
        
      * {
	box-sizing: border-box;
}
body {
	background: #f6f5f7;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: fit-content;
	margin: -40px 0 50px;
}
.container {
    text-align: center;
    color: #fff;
	margin-top:30px;
	background: -webkit-linear-gradient(to right, #17bd4e, #38e772);
	background: linear-gradient(to right, #17bd4e, #38e772);
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 700px;
	max-width: 100%;
	min-height: 480px;
}
form {
	color: white;
	display: flex;
	align-items: left;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

button {
	display: inline;
	border-radius: 20px;
	border: 1px solid white;
	background-color: #17bd4e;
	color: #FFFFFF;
  font-size: 12px;
	font-weight:bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

button:hover{
	color: green;
  border: 1px solid #17bd4e;
	background-color: white;
}

.form-container {
	
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
    left: 0;
	width: 100%;
	z-index: 2;
  align-items: center;
}
input {
	background-color: white;
	border: 1px solid white;
	border-radius: 5px;
	padding: 12px 15px;
	margin: 8px 0;
  width: 50%;
  height: 30px;
}
select {
	position: relative;
  	/* font-family: Arial; */
  background-color: transparent;
  padding: 0 1em 0 0;
  margin: 0;
  width: 50%;
  /* font-family: inherit;
  font-size: inherit; */
  cursor: inherit;
  line-height: inherit;
  z-index: 1;
  border: 1px solid white;
  color: black;
  padding-left: 10px;

}
.selectWrapper{
  width: 50%;
  height: 40px;
  border-radius:6px;
  display:inline-block;
  background:white;
  /* border:0px solid #38e772; */
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


<script>
    $(document).ready(function () {
    $('select').selectize({
        sortField: 'text'
    });
});
</script>
<body>
<button class="logout-btn" onclick="window.location.href='../logout.php'">Logout</button>
<div class="container" id="container">


<h2 style="margin-top: 20px;">Request For Pickup</h2>

<div id="formtag" style="margin-top:30px;">
    <form class="form-container" action="../pickup_process.php" method="POST">
        <div class="selectWrapper">
        <select id="select_state" name="select_state" placeholder="Pick a E-Waste">
        <option value="">Select a Waste...</option>
  <?php
            $sql = "Select waste_id, name from waste";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["waste_id"].'">' . $row["name"] . '</option>';
            }
          ?>
  </select>
       
        </div><br>
        <label for="qty">Select Quantity</label>
        <input type="number" name="qty" id="qty" placeholder="0" required style="height: 40px;"><br>


    
        


        <button type="submit">Submit</button><br>
    </form>
    <button class="backBtn" onclick="window.location.href='../pickup.php'">Back</button>
    </div>

</div>
    

   

</body>
</html>