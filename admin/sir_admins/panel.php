<?php

include("../db.php");
session_start();

if (!$_SESSION['login']) {
    header("location:login_admin.php");
}

$admin = $_SESSION['login'];

$sql = "select * from admins";
$res = mysqli_query($db, $sql);
$admins_data = mysqli_fetch_assoc($res);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate Admin Panel</title>

    <!-- Stylling File Link Here -->
    <link rel="stylesheet" href="../style.css">

    <!-- Icons Link Here -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body>

    <?php

    if ($admin == 'mainadmin@2007') {
        echo "<h1 class='jobs' hidden></h1>";
    } else {
        echo "<h1 class='jobs'>You are Not Type Of This Jobs</h1>";
        echo "<style> body { user-select: none; } </style>";
    }

    ?>

    <?php

    if ($admin == 'mainadmin@2007') {
        echo "<h1 class='jobs' hidden></h1>";
    } else {
        echo "<h1 class='jobs'>You are Not Type Of This Jobs</h1>";
    }

    ?>

    <!-- Admin Panel Structure Here -->

    <!-- Admin Panel Nav -->
    <nav>

        <div class="logo">
            <h1>PassMate</h1>
            <span>admin panel</span>
        </div>

        <div class="info">
            <p><?php echo $admin; ?></p>
            <a href="logout_admin.php">Logout</a>
        </div>

    </nav>
    <?php
    if ($admin == 'mainadmin@2007') {
        ?>
        <!-- Panel Structure -->
        <div class="panel">

            <div class="left">
                <div class="menu">
                    <a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a>
                    <a href="train_form.php"><i class='bx bx-train'></i>( Train ) Forms</a>
                    <a href="bus_form.php"><i class='bx bx-bus'></i>( Bus ) Forms</a>
                    <a href="all_form.php"><i class='bx bx-history'></i>History</a>
                    <a href="#"><i class='bx bx-question-mark'></i>Remarks</a>
                </div>

            </div>

            <div class="right">

                <!-- Panel Content Here -->




                <!-- Javascript file link here -->

            <?php } else { ?>
                <!-- Panel Structure -->
                <div class="panel" id="panel_not">

                    <div class="left">


                    </div>

                    <div class="right">
                    <?php } ?>




</body>

</html>