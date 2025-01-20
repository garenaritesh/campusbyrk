<?php

include("db.php");
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
    <link rel="stylesheet" href="style.css">

    <!-- Icons Link Here -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body>

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

    <!-- Panel Structure -->
    <div class="panel">

        <div class="left">
            <?php
            if ($admin == 'yashbantai2025') {
                ?>
                <div class="menu">
                    <a href="dashboard.php"><span class="material-symbols-sharp">grid_view </span>Dashboard</a>
                    <a href="admins.php"><i class='bx bxs-user-account'></i>Admins</a>
                    <a href="users.php"><i class='bx bx-user'></i>Users</a>
                    <a href="notifi_bar.php"><i class='bx bx-bell'></i>Contacts</a>
                    <a href="notifi_send.php"><i class='bx bx-bell'></i>Notification</a>
                    <a href="delete_requests.php"><i class='bx bxs-user'></i><i class='bx bxs-trash-alt'></i>Requests</a>
                </div>
            <?php } else { ?>
                    <div class="menu">
                        <!-- <a href="#"><span class="material-symbols-sharp">grid_view </span>Dashboard</a> -->
                        <a href="train_form.php">Train (<i class='bx bxs-train'></i>) Forms</a>
                        <a href="bus_form.php">Bus (<i class='bx bxs-bus'></i>) Forms </a>
                        <a href="all_form.php"><span class="material-symbols-sharp">receipt_long </span>Records</a>
                        <!-- <a href="admins.php"><i class='bx bxs-user-account'></i>Admins</a> -->
                        <!-- <a href="notifi_bar.php"><i class='bx bx-bell'></i>Contacts</a> -->
                        <!-- <a href="notifi_send.php"><i class='bx bx-bell'></i>Notification</a> -->
                        <!-- <a href="delete_requests.php"><i class='bx bxs-user'></i><i class='bx bxs-trash-alt'></i>Requests</a> -->
                    </div>
            <?php } ?>
        </div>

        <div class="right">

            <!-- Panel Content Here -->




            <!-- Javascript file link here -->


</body>

</html>