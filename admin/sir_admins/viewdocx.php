<?php

include("../db.php");
session_start();

if (!$_SESSION['login']) {
    header("location:login_admin.php");
}


if (isset($_REQUEST['packs'])) {
    $packs = $_REQUEST['packs'];
    $sql = "select * from train_forms where train_form_id = '$packs'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> View Documents </title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Body Content Here -->
    <div class="docx">
        <a href="train_form.php" id="back"><i class='bx bx-left-arrow-alt'></i></a>
        <div class="docx_box">
            <img src="../images/<?php echo $row['profile_pic']; ?>" alt="">
            <span id="adhar_card">Profile Pic</span>
        </div>
        <div class="docx_box">
            <img src="../images/<?php echo $row['adhar_card']; ?>" alt="">
            <span id="adhar_card">Adhar Card</span>
        </div>
        <div class="docx_box">
            <img src="../images/<?php echo $row['fees_receipt']; ?>" alt="">
            <span id="adhar_card">Fees Receipt</span>
        </div>
        <div class="docx_box">
            <img src="../images/<?php echo $row['i_card']; ?>" alt="">
            <span id="adhar_card">I-Card</span>
        </div>
        <div class="docx_box">
            <img src="../images/<?php echo $row['signature']; ?>" alt="">
            <span id="adhar_card">Signature</span>
        </div>
    </div>



    <!-- Javascript file link here -->


</body>

</html>