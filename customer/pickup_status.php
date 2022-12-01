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


<div id="status">
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
                $sql5 = "select s.select_id as select_id, w.name as name, s.qty as qty from selects as s join waste as w on w.waste_id = s.waste_id join customer as c on c.cust_id = s.cust_id where s.schedule_id=0 and c.cust_id = $custid;";
                $result5 = mysqli_query($conn, $sql5);
                while ($row3 = mysqli_fetch_assoc($result5)) {
                  echo '<tr><td>' . $row3["name"] . '</td><td>' . $row3["qty"] . '</td><td><button class="btn btn-secondary"><a style="text-decoration:none;" href="../update_pickup.php?updateid='.$row3["select_id"]. '" class="text-light">Edit</a></button></td><td><button class="btn btn-danger"><a style="text-decoration:none;" href="../remove_pickup.php?deleteid='.$row3["select_id"]. '" class="text-light">Delete</a></button></td>';
                }
              ?>
            </tbody>
        </table>
    </div>
              

              <button id="status_back_btn" onclick="window.location.href='../pickup.php'">Back</button>
              </div>
</div>
    

   

</body>
</html>






























