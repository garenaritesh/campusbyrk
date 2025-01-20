<?php

include("db.php");
session_start();

if (isset($_REQUEST['viewform'])) {
    $id = $_REQUEST['viewform'];
    $sql = "select * from complets_train_forms where complete_train_form_id = '$id'";
    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($res);
    // header("location:user_form_view.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Form View | Passmate </title>
    <link rel="stylesheet" href="user_form.css">
</head>

<body>

    <!-- Body Content Here -->
    <div class="form_view">
        <div class="top">
            <div class="profile_pic">
                <img src="images/<?php echo $row['profile_pic']; ?>" alt="">
            </div>
            <div class="user_dtl">
                <h2><?php echo $row['full_name']; ?> | <?php echo $row['gender']; ?> | <?php echo $row['cast']; ?></h2>
                <h3><?php echo $row['email']; ?> | <?php echo $row['phone']; ?></h3>
                <h3><?php echo $row['dob']; ?> | <?php echo $row['age']; ?></h3>
                <h3><?php echo $row['department']; ?> | <?php echo $row['sem']; ?></h3>
                <h3><?php echo $row['departure']; ?> to <?php echo $row['destination']; ?> | <?php echo $row['months']; ?>
                </h3>
                <h3><?php echo $row['address']; ?></h3>
            </div>
        </div>
        <div class="bottom">
            <h3>Documents</h3>
            <div class="docs">
                <div class="docs_frame">
                    <div class="doc_title">Adhar Card</div>
                    <img src="images/<?php echo $row['adhar_card']; ?>" alt="">
                </div>
                <div class="docs_frame">
                    <div class="doc_title">I-Card</div>
                    <img src="images/<?php echo $row['i_card']; ?>" alt="">
                </div>
                <div class="docs_frame">
                    <div class="doc_title">Fees Receipt</div>
                    <img src="images/<?php echo $row['fees_receipt']; ?>" alt="">
                </div>
                <?php
                if ($row['ration_card'] == '') {
                    ?>
                <?php } else {
                    ?>
                    <div class="docs_frame">
                        <div class="doc_title">Ration Card</div>
                        <img src="images/<?php echo $row['ration_card']; ?>" alt="">
                    </div>
                <?php
                } ?>
                <div class="docs_frame">
                    <div class="doc_title">Signature</div>
                <img src="images/<?php echo $row['signature']; ?>" alt="">
            </div>
        </div>
    </div>
    </div>


    <!-- Javascript file here -->


</body>

</html>