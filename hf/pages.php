<?php

session_start();

include('../admin/db.php');

if (!$_SESSION['logins']) {
    header("location:../users/login.php");
}

$user = $_SESSION['logins'];

// Notification Data Read
$sql = "SELECT * FROM notification WHERE user = '$user' ORDER BY date DESC";
$res = mysqli_query($db, $sql);

// Count unread notifications
$sql_unread = "SELECT COUNT(*) as unread_count FROM notification WHERE user = '$user' AND is_read = 0";
$unread_count_result = mysqli_query($db, $sql_unread);
$unread_count = mysqli_fetch_assoc($unread_count_result)['unread_count'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate </title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../pages/form.css"> -->
    <link rel="stylesheet" href="../pages/style.css">
    <link rel="stylesheet" href="../pages/index.css">
    <link rel="stylesheet" href="../pages/application.css">
    <!-- <link rel="stylesheet" href="../users/style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Body Content Here -->

    <!-- Nav -->
    <nav>
        <div class="logo">
            <a href="../pages/index.php"> <span>C</span>ampus<span>C</span>orner </a>
        </div>
        <ul class="navlist">
            <li id="forms"><a href="#">Forms</a></li>
            <li><a href="../pages/about.php">About</a></li>
            <li><a href="../pages/contact.php">ContactUs</a></li>
        </ul>
        <ul class="user_list">
            <a href="../users/notification.php"><i class='bx bx-bell'></i>
                <span id="count_notifi"
                    class="count <?php echo $unread_count > 0 ? 'show' : ''; ?>"><?php echo $unread_count; ?></span>
            </a>
            <li id="user_icon"><a href="../pages/user_account.php"><i class='bx bx-user'></i></a></li>
        </ul>
    </nav>

    <!-- Extra Nav To Select To User Where they are going.. -->
    <div id="extra_nav" class="extra_nav">
        <a href="../pages/trainform.php"><i class='bx bx-train'></i> Train Application </a>
        <a href="../pages/busform.php"><i class='bx bxs-bus'></i> Bus Application </a>
    </div>



</body>

</html>