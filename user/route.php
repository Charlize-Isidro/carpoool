<?php

include '../includes/connection.php';

$user_id = $_SESSION['auth_id'];

// Checks the Email & Password
$sql = "SELECT * FROM userinfo INNER JOIN passengerinfo ON userinfo.UserID = passengerinfo.UserID WHERE userinfo.UserID='$user_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (is_null($row['TimeConfirmed'])) {
    $pass_id_confirmed = 'false';
} else {
    $pass_id_confirmed = 'true';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool App</title>

    <!-- Favicons -->
   <link href="logo.png" rel="icon" >
    
</head>

<body >


    <div class="container my-3 col-lg-5">
    <!-- <img src="carpoollogo.png" class="centerpic"> -->

        <form action="update_process.php" method="post">

            <h1 class="mb-3"> Creating route </h1>
            <hr>

           

            <div class="row">
                
                <div class="mb-3 col-8">
                    <label for="st" class="form-label">Pick-Up Location<span class="text-danger">*</span></label>
                    <input type="text" name="st" id="pick-up" class="form-control" >
                </div>
                <div class="mb-3 col-8">
                    <label for="st" class="form-label">Drop- off Location <span class="text-danger">*</span></label>
                    <input type="text" name="st" id="pick-up" class="form-control" >
                </div>
                <div class="mb-3 col-8">
                    <label for="st" class="form-label">Seat <span class="text-danger">*</span></label>
                    <input type="text" name="st" id="pick-up" class="form-control" >
                </div>
            </div>

            </div>

            <hr>


            <div class="row">
                <div class="col">
                    <input type="submit" name="register" value="Route" class="btn btn-primary">
                    <a href="view_cars.php" class="btn btn-secondary" > Back </a>
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