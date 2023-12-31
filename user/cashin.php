<?php

include '../includes/connection.php';
include_once '../includes/auth.php';

$user_id = $_SESSION['auth_id'];

// Checks the Email & Password
$sql = "SELECT * FROM userinfo INNER JOIN passengerinfo ON userinfo.UserID = passengerinfo.UserID WHERE userinfo.UserID='$user_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$type = $row['UserLevel'];

if (is_null($row['TimeConfirmed'])) {
    $pass_id_confirmed = 'false';
} else {
    $pass_id_confirmed = 'true';
}

// Retrieves User
$sql = "SELECT * FROM userinfo WHERE UserID=$id";
$result = $connection->query($sql);

// Retrieves Pending Car Approval
$car_sql = "SELECT * FROM car WHERE DriverID = '$id';";
$car_result = $connection->query($car_sql);

// Retrieves Passenger
$pass_sql = "SELECT * FROM passengerinfo WHERE UserID=$id";
$pass_result = $connection->query($pass_sql);
$pass_row = $pass_result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Along Rendezvous | User Cash In</title>
<!--    
    <style>
        /* Remove Arrows on Number Textfield */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        body,
        html {
            font-family: 'Bruno Ace Sc';
        }



body{
    font-family: 'Bruno Ace Sc';
}
h1, tr, th, td, a{
    font-family: 'Bruno Ace Sc';
}

.button{
    font-family: 'Bruno Ace Sc';
}
.topnav {
overflow: hidden;
background-color: #333;
}

.topnav a {
float: right;
color: #f2f2f2;
text-align: center;
padding: 14px 16px;
text-decoration: none;
font-size: 17px;
}

.topnav a:hover {
background-color: #ddd;
color: black;
}

.topnav a.active {
background-color: #04AA6D;
color: white;
}



    </style> -->
    <?php
        if (!is_null($pass_row['TimeConfirmed'])) :
        ?>
          <div class="topnav">  <a href="car_register.php"> Register a Car </a> </div>
        <?php endif; ?>

        <div class="topnav"><a href="update.php" > Update Profile </a></div>

        <?php
        if ($car_result->num_rows > 0) :
        ?>
            <div class="topnav"> <a href="view_cars.php"> View Cars </a></div>
        <?php endif; ?>
    
        <div class="topnav"> <a href="../user/cashin.php" > Cash In </a></div>
        <?php
    if ($type == 'driver') :
    ?>
            <div class="topnav"> <a href="../user/dcashout.php"> Cash Out </a></div>
        <?php endif; ?>

        <div class="topnav"> <a href="../config/logout.php" > Logout </a></div>
</head>

<body >


    <div class="container my-3 col-lg-5">
    
        <form action="../config/cashin.php" method="post">

            <h1 class="mb-3"> Cash In Page </h1>
            <hr>

            <div class="row">

            </div>

            <div class="row">
                <div class="mb-3 col-5">
                    <label for="contact_no" class="form-label">Contact Number</label>
                    <input type="number" required name="contact_no" id="contact_no" class="form-control">
                </div>


                    <div class="row">
               
                <div class="mb-3 col-6">
                    <label for="idtype" class="form-label">Amount to Cash In</label>
                    <select class="form-select" required name="amount" id="amount" aria-label="Default select example">
                        <option value=""  >-- Select -- </option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                        <option value="250" >250</option>
                        <option value="300" >300</option>
                        <option value="400" >400</option>
                        <option value="500" >500</option>
                        
                    </select>
                </div>
                
            </div> 
            
                            <div class="row">
                                <div class="mb-3 col-8">
                                    <label for="ref" class="form-label">Reference Number</label>
                                    <input type="number" required name="ref" id="ref" class="form-control">
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="register" value="Cash In" class="btn btn-primary" >
                                        <a href="profile.php" class="btn btn-secondary" > Back </a>
                                        <!-- <a href="../config/cashin.php" class="btn btn-secondary" style="background-color:#161B30"> CashIn </a> -->
                                    </div>
                                </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>