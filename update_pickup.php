<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
	margin: 100px 0 50px;
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
}
input {
	background-color: white;
	border: 1px solid white;
	border-radius: 5px;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}
select {
	position: relative;
  	/* font-family: Arial; */
  background-color: transparent;
  padding: 0 1em 0 0;
  margin: 0;
  width: 100%;
  height: 40px;
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
  
  border-radius:6px;
  display:inline-block;
  overflow:hidden;
  background:white;
  /* border:0px solid #38e772; */
}
    </style>
</head>
<body>
<div class="container">
    <h1 style="margin-bottom: 50px;">Modify Request</h1>
<form class="form-container" action="update_pickup_req.php" method="POST">
<input type="number" value=<?php echo "\"" . $_GET["updateid"] . "\"" ?> name="id" readonly hidden>
<label for="Wname" style="margin-bottom:10px;">Select type</label>
        <div class="selectWrapper">
        <select name="wid" id="wid">
          <?php
          include 'sqlconn.php';
            $sql = "Select * from waste_types";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row["waste_id"].'">'.$row["waste_type"].'</option>';
            }
          ?>
        </select>
        </div><br>
        <label for="qty">Select Quantity</label>
        <input type="number" name="qty" id="qty" placeholder="0" required><br>
        <button type="submit">Submit</button><br>
    </form>
    <button onclick="window.location ='pickup.php' ">Back</button>
</div>
</body>
</html>