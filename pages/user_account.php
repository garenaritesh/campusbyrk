<?php
include("../hf/pages.php");


// Current Applyer Check of User
$sql = "select * from train_forms where email = '$user'";
$caresult = mysqli_query($db, $sql);
$ca = mysqli_num_rows($caresult);

// Current Applyer Check of User Of Bus Pass
$sql = "select * from bus_forms where email = '$user'";
$busresult = mysqli_query($db, $sql);
$buscount = mysqli_num_rows($busresult);


// History Check Of User
$sql = "select * from complets_train_forms where email = '$user'";
$dresult = mysqli_query($db, $sql);
$forpass = mysqli_query($db, $sql);
$history = mysqli_num_rows($dresult);
$check_row = mysqli_fetch_assoc($dresult);

$sql = "select * from complets_train_forms where email = '$user' and status = 'success'";
$ss = mysqli_query($db, $sql);
$sscount = mysqli_num_rows($ss);

// Expired Pass Count Script Here
$sql = "select * from complets_train_forms where email = '$user' and status = 'Expired'";
$expired_count = mysqli_num_rows(mysqli_query($db, $sql));
// End of Expired Pass Count Script Here

// Automatically Expired Date Of Bonafide Screipt Here
$sql = "UPDATE complets_train_forms 
        SET status = 'Expired' 
        WHERE status = 'success' 
        AND form_date <= NOW() - INTERVAL 2 DAY";
$expired = mysqli_query($db, $sql);

// Count Train Form Id 
$sql = "show columns from complets_train_forms";
$checks = mysqli_query($db, $sql);

// History
$history_sql = "select * from complets_train_forms where email = '$user'";
$user_history = mysqli_query($db, $history_sql);


// User Data
$sql = "select * from users where email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql));

// if ($pass > 0) {

//     echo "<p>Pass: TrainPass</p>echo ";
// } else {

//     echo "<p>Pass: BussPass</p>echo ";

// }

// $data = date("Y-m-d", strtotime($start['form_date']));

// Pending and Succes Pass Logic Here


?>


<?php
if ($ca < 1) {
?>
<?php
}
?>
<style>
    #remark {
        color: red;
    }

    #remark a {
        color: red;
        text-decoration: none;
    }
</style>

<!-- User Tabs -->
<!-- User Notification -->


<div class="user_info">
    <div class="user_img">
        <?php
        if ($user_info['user_pic'] == '') {
            ?>
            <img src="../admin/assets/user_img.jpg" alt="">
            <?php
        } else {
            ?>
            <img src="../admin/images/<?php echo $user_info['user_pic']; ?>" alt="">
            <?php
        }
        ?>
    </div>
    <div class="user_dtl">

        <?php
        $user_name = $user_info['name'];
        if ($user_info['name'] == '') {
            echo "<h1>Passmate User</h1>";
        } else {
            echo "<h1>$user_name</h1>";
        } ?>

        <p>Passmate Member Since <?php echo date("Y", strtotime($user_info['date'])) ?></p>
    </div>
</div>


<!-- User Tabs -->
<div class="user_tabs">
    <ul class="tab">
        <li><a href="../users/orders.php">Orders</a></li>
        <li class="c_tab"><a href="../pages/user_account.php">Passes</a></li>
        <li><a href="../users/user_info.php">Account</a></li>
        <li><a href="../users/notification.php">Notification</a></li>
        <li><a href="../users/setting.php">Setting</a></li>
    </ul>
</div>



<section class="slider">
    <h3>Current Applyer</h3>
    <div class="container" id="user_account_container">
        <?php if ($ca > 1 or $ca == 1) {
            while ($train_row = mysqli_fetch_array($caresult)) { ?>
                <div class="row">
                    <div class="notifi">
                        <div class="dot"></div>
                        <?php
                        if ($train_row['status'] == 'Remark') { ?>
                            <div class="alert_name" Id="remark"><a
                                    href="../users/notification.php"><?php echo $train_row['status']; ?>?</a></div>
                        <?php } else { ?>
                            <div class="alert_name"><?php echo $train_row['status']; ?></div>
                        <?php } ?>
                    </div>
                    <div class="info">
                        <p>#<?php echo $train_row['train_form_id']; ?></p>
                        <p><?php echo $train_row['full_name']; ?></p>
                        <p>Pass : Train Pass</p>
                        <p>Cost : Free</p>
                        <p>Date : <?php echo date("Y-m-d", strtotime($train_row['form_date'])) ?></p>
                    </div>
                </div>
            <?php }
        }
        if ($buscount > 0 or $buscount == 1) {
            while ($bus_row = mysqli_fetch_assoc($busresult)) { ?>
                <div class="row">
                    <div class="notifi">
                        <div class="dot"></div>
                        <?php
                        if ($bus_row['status'] == 'Remark') { ?>
                            <div class="alert_name" Id="remark"><a
                                    href="../users/notification.php"><?php echo $bus_row['status']; ?>?</a></div>
                        <?php } else { ?>
                            <div class="alert_name"><?php echo $bus_row['status']; ?></div>
                        <?php } ?>
                    </div>
                    <div class="info">
                        <p>#<?php echo $bus_row['bus_form_id']; ?></p>
                        <p><?php echo $bus_row['full_name']; ?></p>
                        <p>Pass : Bus Pass</p>
                        <p>Cost : Free</p>
                        <p>Date : <?php echo date("Y-m-d", strtotime($bus_row['form_date'])) ?></p>
                    </div>
                </div>
            <?php }
        } ?>
        <?php
        if ($sscount > 0) {
            while ($ss_row = mysqli_fetch_assoc($ss)) { ?>
                <div class="row">
                    <div class="notifi">
                        <div class="dot" style="background: green;"></div>
                        <div class="alert_name" style="color: green;"><?php echo $ss_row['status']; ?></div>
                    </div>
                    <div class="info">
                        <?php
                        if ($ss_row['train_form_id'] == 0) {
                            ?>
                            <p>#<?php echo $ss_row['bus_form_id']; ?></p>
                        <?php } else if ($ss_row['bus_form_id'] == 0) { ?>
                                <p>#<?php echo $ss_row['train_form_id']; ?></p>
                        <?php } ?>
                        <p><?php echo $ss_row['full_name']; ?></p>
                        <?php
                        if ($ss_row['train_form_id'] == 0) {
                            echo "<p>Pass: BussPass</p>";
                        } else if ($ss_row['bus_form_id'] == 0) {
                            echo "<p>Pass: TrainPass</p>";
                        }
                        ?>
                        <p>Cost : Free</p>
                        <p>Date : <?php echo date("Y-m-d", strtotime($ss_row['form_date'])) ?></p>
                    </div>
                </div>
                <?php
            }
        } ?>

    </div>
</section>

<!-- User Account History Will Be Show here like user how many time apply the for from -->

<section class="slider">
    <h3><i class='bx bx-history'></i> History or Expired Bonafides</h3>
    <div class="container">
        <?php if ($expired_count < 0 or $expired_count == 0) { ?>
            <h3>Start fresh! Apply now and create your pass history.</h3>
        <?php } else {
            while ($expired_row = mysqli_fetch_assoc($user_history)) { ?>
                <div class="row">
                    <div class="notifi">
                        <div class="dot" style="background: #D32F2F;"></div>
                        <div class="alert_name" style="color: #D32F2F"><?php echo $expired_row['status']; ?></div>
                    </div>
                    <div class="info">
                        <p>#<?php echo $expired_row['complete_train_form_id']; ?></p>
                        <p><?php echo $expired_row['full_name']; ?></p>
                        <?php
                        if ($check_row['train_form_id'] == 0) {
                            echo '<p>Pass : Bus Pass</p>';
                        } else if ($check_row['bus_form_id'] == 0) {
                            echo '<p>Pass : Train Pass</p>';
                        }

                        ?>
                        <p>Cost : Free</p>
                        <p>Date : <?php echo date("Y-m-d", strtotime($expired_row['form_date'])) ?></p>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</section>


<?php

include("../hf/footer.php");

?>