<?php

include '../includes/connection.php';

$user_id = $_SESSION['auth_id'];

// Retrieves Pending Car Approval
$sql = "SELECT * FROM car WHERE DriverID = '$user_id';";
$result = $connection->query($sql);

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> View Cars </title>

 

</head>

<body >

    <div class="container my-3">

        <?php
        if (!empty($_SESSION['message'])) :
        ?>
            <div class="alert alert-<?= $bg ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['bg']);
        endif ?>

        <h1> My Cars </h1>
        <hr>

        <table class="table-responsive" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Car Plate No</th>
                    <th scope="col" class="text-center">Car Model</th>
                    <th scope="col" class="text-center">Car Color</th>
                    <th scope="col" class="text-center">Car Brand</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) :
                    $x = 1;
                    while ($row = $result->fetch_assoc()) :
                ?>
                        <tr>
                            <th class="text-center"> <?= $x ?> </th>
                            <td class="text-center"> <?= $row['LicensePlate'] ?> </td>
                            <td class="text-center"> <?= $row['CarModel'] ?> </td>
                            <td class="text-center"> <?= $row['CarColor'] ?> </td>
                            <td class="text-center"> <?= $row['CarBrand'] ?> </td>
                            <td class="text-center">

                                <?php
                                if ($row['Status'] == 1) :
                                ?>
                                    <p class="text-danger align-center"> Rejected </p>

                                <?php elseif (is_null($row['TimeCarConfirmed'])) : ?>
                                    <p class="text-warning"> Pending for Approval </p>

                                <?php else : ?>
                                    <a href= "route.php" class="btn btn-primary" > Create Route </a>

                                <?php endif; ?>
                            </td>
                            <!-- <td> <?= date("M d, Y H:i A", strtotime($row['TimeVerified'])) ?> </td> -->
                            <!-- date("M d, Y H:iA", strtotime($row['user_verified_at']) -->
                        </tr>
                <?php
                        $x++;
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>

        <hr>
        <a href="profile.php" class="btn btn-secondary" > Back </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>