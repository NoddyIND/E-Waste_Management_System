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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
.logout-btn{
  margin-top: 70px;
    margin-left: 70%;
	margin-bottom: 30px;
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

tr:hover{
  background: white;
  border: 1px solid #17bd4e;
}

    </style>
     <script src="pickup.js"></script>
</head>
<body>
<button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    <div class="container">
        <br>
    <h1>Welcome <?php 
    
    include 'sqlconn.php';
    $email = $_SESSION["email"];
    $sql = "select * from user where email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['name'];
    ?></h1>




    <button id="request" style="margin-top:50px;" onclick="formDisplay()">Request Pickup</button>
    <div id="formtag" style="display: none;">
    <form class="form-container" action="pickup_process.php" method="POST">
    <input type="text" value=<?php echo $email ?> name="useremail" readonly hidden>
    
        <label for="Wname" style="margin-bottom:10px;">Select type</label>
        <div class="selectWrapper">
        <select name="wid" id="wid">
          <?php
            $sql = "Select * from waste_types";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["waste_id"].'">' . $row["waste_type"] . '</option>';
            }
          ?>
        </select>
        </div><br>
        <label for="qty">Select Quantity</label>
        <input type="number" name="qty" id="qty" placeholder="0" required><br>
        <button type="submit">Submit</button><br>
    </form>
    <button class="backBtn" onclick="closeReq()">Back</button>
    </div>


    <div id="achive" style="display: none;"> 
        <h3 style="margin-top: 50px;">Your Contribution towards Environment</h3>  
        <?php
        $sql = "select w.weight, p.qty from pickup as p join waste_types as w on w.waste_id = p.wid where p.email = '$email' and p.recycle_decompose != 0";
        $result = mysqli_query($conn, $sql);
        
        if($result == false)
        {
          echo '<script>
          if ( document.getElementById("achievement") )
            document.getElementById("achievement").style.display="none";
             </script>';
        }
        else{
          echo '<script>
          if ( document.getElementById("achievement") )
              document.getElementById("achievement").style.display="";
           </script>';
          $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            
            $total = $total + ($row['weight']*$row['qty']);
        }
        }
        
        
        $sql1 = "select w.weight, p.qty from pickup as p join waste_types as w on w.waste_id = p.wid where p.email = '$email' and p.recycle_decompose = 1";
        $result1 = mysqli_query($conn, $sql1);
        if($result1 == false)
        {
          echo '<script>
           </script>';
        }
        else{
          echo '<script>
          
           </script>';
          $recycle = 0;
          while ($row = mysqli_fetch_assoc($result1)) {
              
              $recycle = $recycle + ($row['weight']*$row['qty']);
  
          }
          $recy =round(($recycle / $total)* 100);
          $styleper = (((360/100) * $recy)/2)."deg";
          echo "<script>
          document.documentElement.style.setProperty('--recy', '$styleper'); 
                </script>";
        }
        

        

              $sql2 = "select w.weight, p.qty from pickup as p join waste_types as w on w.waste_id = p.wid where p.email = '$email' and p.recycle_decompose = 2";
              $result2 = mysqli_query($conn, $sql2);
              if($result2 == false)
              {
                echo '<script>
                
                 </script>';
              }
              else{
                echo '<script>
                if ( document.getElementById("achievement") )
            document.getElementById("achievement").style.display="";
                </script>';
                $decompose = 0;
              while ($row = mysqli_fetch_assoc($result2)) {
                
                  $decompose = $decompose + ($row['weight']*$row['qty']);
      
              }
              $deco =round(($decompose / $total)* 100);
              $styleperdeco = (((360/100) * $deco)/2)."deg";
              echo "<script>
              document.documentElement.style.setProperty('--deco', '$styleperdeco'); 
                    </script>";
              }

        ?>
        <div id="col_sep">
          <div class="recycle_round">
            <h3 style="margin-top: 50px; margin-left: -320px;">Recycled</h3>
            <div class="circle-wrap">
              <div class="circle">
                <div class="mask half">
                  <div class="fill"></div>
                </div>
                <div class="mask full">
                  <div class="fill"></div>
                </div>
                <div class="inside-circle"> <?php if($result1 == true) 
                                                      echo $recy;?>% </div>
              </div>
            </div>
          </div>
          <div class="decompose_round">
          <h3 style="margin-top: -205px; margin-left: 320px;">Decomposed</h3>
            <div class="circle-wrap" style="margin-left: 430px;">
              <div class="circled">
                <div class="maskd half">
                  <div class="filld"></div>
                </div>
                <div class="maskd fulld">
                  <div class="filld"></div>
                </div>
                <div class="inside-circle"> <?php if($result2 == true)
                                                      echo $deco;?>% </div>
              </div>
            </div>
          </div>
        </div>
        <div id="detail" style="display: none;">
          <div class="recycle_details">
            <br><br>
            <div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Waste Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Recycle / Decompose</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $sql4 = "select w.waste_type, p.qty, p.recycle_decompose from pickup as p join waste_types as w on w.waste_id = p.wid where p.email = '$email' and p.recycle_decompose = 1 or p.recycle_decompose = 2;";
              $result4 = mysqli_query($conn, $sql4);
              while ($row2 = mysqli_fetch_assoc($result4)) {
                  if($row2["recycle_decompose"]==1){
                    $set = "Recycle";
                  }
                  else if($row2["recycle_decompose"]==2){
                    $set = "Decompose";
                  }
                  echo '<tr><td>' . $row2["waste_type"] . '</td><td>' . $row2["qty"] . '</td><td>' . $set .'</td>';
              }

              ?>
            </tbody>
        </table>
    </div>
            
          </div>
        </div>
        <button id="detail_btn" style="margin-top: 30px;" onclick="details()">Details</button><br>
        <button style="margin-top: 20px;" onclick="backAchive()">Back</button>


    </div>
    <div id="status" style="display: none;">
    <div>
      <h3 style="margin-top: 30px;">Your Requests</h3>
        <table class="table table-bordered table-hover" style="margin-top:30px;">
            <thead>
                <tr>
                    <th scope="col">Waste Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Modify</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql5 = "select p.id, w.waste_type, p.qty from pickup as p join waste_types as w on w.waste_id = p.wid where is_collected=0 and email='$email';";
                $result5 = mysqli_query($conn, $sql5);
                while ($row3 = mysqli_fetch_assoc($result5)) {
                  echo '<tr><td>' . $row3["waste_type"] . '</td><td>' . $row3["qty"] . '</td><td><button class="btn btn-secondary"><a style="text-decoration:none;" href="update_pickup.php?updateid='.$row3["id"]. '" class="text-light">Edit</a></button></td><td><button class="btn btn-danger"><a style="text-decoration:none;" href="remove_pickup.php?deleteid='.$row3["id"]. '" class="text-light">Delete</a></button></td>';
                }
              ?>
            </tbody>
        </table>
    </div>
              

              <button id="status_back_btn" onclick="status_back()">Back</button>
    </div>
    <br>
    <button id="btn_status" style="margin-top:50px;" onclick="status()">Pickup Request</button><br>
    <?php
      $sql6 = "select * from pickup where is_collected=0 and email='$email'";
      $result6 = mysqli_query($conn, $sql6);
      if(mysqli_fetch_assoc($result6) == false){
        echo '<script>document.getElementById("btn_status").style.display="none";</script>';
      }
      else{
        echo '<script>document.getElementById("btn_status").style.display="";</script>';
      }
    ?>

    <button id="achievement" style="margin-top:50px;" onclick="achive()">Achievements</button>
    </div>

    
   
</body>
</html>