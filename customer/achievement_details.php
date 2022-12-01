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
<link rel="stylesheet" href="../customer.css">
<title>Document</title>
</head>

<body>
<button class="logout-btn" onclick="window.location.href='../logout.php'">Logout</button>
<div class="container" id="container">


<div id="detail">
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
              $sql4 = "select w.name as name, s.qty as qty, c.cust_name, rd.recycle_decompose as recycle_decompose from selects as s join waste as w on w.waste_id = s.waste_id join customer as c on c.cust_id = s.cust_id join recycle_decompose as rd on rd.select_id=s.select_id where c.cust_id = $custid;";
              $result4 = mysqli_query($conn, $sql4);
              while ($row2 = mysqli_fetch_assoc($result4)) {
                  if($row2["recycle_decompose"]==1){
                    $set = "Recycle";
                  }
                  else if($row2["recycle_decompose"]==2){
                    $set = "Decompose";
                  }
                  echo '<tr><td>' . $row2["name"] . '</td><td>' . $row2["qty"] . '</td><td>' . $set .'</td>';
              }

              ?>
            </tbody>
        </table>
    </div>
            
          </div>
          <button style="margin-top: 20px;" onclick="window.location.href='achievement.php'">Back</button>
        </div>

</div>
    

   

</body>
</html>



