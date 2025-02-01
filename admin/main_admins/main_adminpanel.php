<?php

include("../db.php");
session_start();

if (!$_SESSION['main_logins']) {
    header("location:main_admin_login.php");
}

$mainadmin = $_SESSION['main_logins'];

$sql = "select * from admins";
$res = mysqli_query($db, $sql);
$admins_data = mysqli_fetch_assoc($res);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CampusCorner Admin Panel</title>

    <!-- Stylling File Link Here -->
    <link rel="stylesheet" href="../style.css">

    <!-- Qr Code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <!-- Icons Link Here -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body>

    <?php

    if ($mainadmin == 'creators') {
        echo "<h1 class='jobs' hidden></h1>";
    } else {
        echo "<h1 class='jobs'>You are Not Type Of This Jobs</h1>";
        echo "<style> body { user-select: none; } </style>";
    }

    ?>


    <!-- Admin Panel Structure Here -->

    <?php

    if ($mainadmin == 'creators') {
        echo "<h1 class='jobs' hidden></h1>";
    } else {
        echo "<h1 class='jobs'>You are Not Type Of This Jobs</h1>";
    }

    ?>


    <!-- Admin Panel Nav -->
    <nav>

        <div class="logo">
            <h1>PassMate</h1>
            <span>admin panel</span>
        </div>

        <div class="info">
            <p><?php echo $mainadmin; ?></p>
            <a href="logout_mains.php">Logout</a>
        </div>

    </nav>

    <?php
    if ($mainadmin == 'creators') {
        ?>
        <!-- Panel Structure -->
        <div class="panel">

            <div class="left">

                <div class="menu">
                    <a href="dashboard.php"><span class="material-symbols-sharp">grid_view </span>Dashboard</a>
                    <a href="admins.php"><i class='bx bxs-user-account'></i>Admins</a>
                    <a href="users.php"><i class='bx bx-user'></i>Users</a>
                    <a href="notifi_bar.php"> <span> 📧 </span> Contacts</a>
                    <a href="notifi_send.php"><i class='bx bx-bell'></i>Notification</a>
                    <a href="delete_requests.php"><i class='bx bxs-user'></i><span>🗑️</span>Requests</a>
                    <a href="orders.php"><span>📦</span>Orders</a>

                </div>

            </div>

            <div class="right">

                <!-- Panel Content Here -->

            <?php } else { ?>
                <!-- Panel Structure -->
                <!-- Panel Structure -->
                <div class="panel" id="panel_not">

                    <div class="left">


                    </div>

                    <div class="right">

                    <?php } ?>


                    <!-- Javascript file link here -->


</body>

</html>