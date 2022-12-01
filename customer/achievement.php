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
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<title>Document</title>
</head>
    <link rel="stylesheet" href="../customer.css">
<body>
<button class="logout-btn" onclick="window.location.href='../logout.php'">Logout</button>
<div class="container" id="container">


<div id="achive"> 
        <h3 style="margin-top: 50px;">Your Contribution towards Environment</h3>  
        <?php
        $sql = "select w.weight as weight, s.qty as qty, c.cust_name from waste as w join selects as s on w.waste_id = s.waste_id join customer as c on c.cust_id = s.cust_id where s.schedule_id != 0 and c.cust_id = $custid and s.is_collected= 1; ";
        $result = mysqli_query($conn, $sql);
        
        if($result == false)
        {
          echo 'Nothing to Display';
        }
        else{
          $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            
            $total = $total + ($row['weight']*$row['qty']);
        }
        }
        
        
        $sql1 = "select w.weight as weight, s.qty as qty from waste as w join selects as s on w.waste_id = s.waste_id join customer as c on c.cust_id = s.cust_id join recycle_decompose as rd on rd.select_id=s.select_id where s.schedule_id != 0 and rd.recycle_decompose=1 and c.cust_id= $custid";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_fetch_assoc($result1) == true)
        {
            mysqli_free_result($result1);
            $result1 = mysqli_query($conn, $sql1);
          $recycle = 0;
          while ($row = mysqli_fetch_assoc($result1)) {
              
              $recycle = $recycle + ($row['weight']*$row['qty']);
  
          }
          $recy =round(($recycle / $total)* 100);
          $styleper = (((360/100) * $recy)/2)."deg";
          echo "<script>
          document.documentElement.style.setProperty('--recy', '$styleper'); 
                </script>";
        

        ?>
        <div id="col_sep">
          <h5>You have donated <b><?php echo $total;?>kg</b> of Ewaste among which <b>
            <?php 
                echo $recycle ?>kg</b> is recycled</h5>
          <div class="recycle_round">
            <h3 style="margin-top: 50px;">Recycled</h3>
            <div class="circle-wrap" style="margin-left:270px;">
              <div class="circle" >
                <div class="mask half">
                  <div class="fill"></div>
                </div>
                <div class="mask full">
                  <div class="fill"></div>
                </div>
                <div class="inside-circle"> <?php if($result1 == true) 
                                                      echo $recy , '%'; ?> </div>
        
              </div>
            </div>
            
          </div>
          <?php
        }
          else {
            echo 'Nothing to display';
          }
        ?>
        </div>
       


        <button id="detail_btn" style="margin-top: 30px;" onclick="window.location.href='achievement_details.php'">Details</button><br>
        <button style="margin-top: 20px; margin-bottom:20px;" onclick="window.location.href='../pickup.php'">Back</button>


    </div>

</div>
    

   

</body>
</html>