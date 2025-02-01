<?php

include("../hf/users_h.php");

// Notification Data Read

$sql = "select * from notification";
$res = mysqli_query($db, $sql);

// User Data
$sql = "select * from users where email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql));

?>

<style>
    .setting_content {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        justify-content: center;
    }


    .setting_content button {
        width: 300px;
        background: black;
        color: white;
        padding: 15px;
        border: none;
        outline: none;
        cursor: pointer;
    }

    .setting_content button a {
        text-decoration: none;
        color: white;
    }

    .setting p {
        text-align: center;
    }
</style>

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
        <li><a href="orders.php">Orders</a></li>
        <li><a href="../pages/user_account.php">Passes</a></li>
        <li><a href="user_info.php">Account</a></li>
        <li><a href="notification.php">Notification</a></li>
        <li class="c_tab"><a href="setting.php">Setting</a></li>
    </ul>
</div>


<div class="container setting">


    <!-- Setting Content Here -->
    <div class="setting_content">
        <button><a href="change_password.php">Update Password</a></button>
        <button><a href="delete_account.php">Delete Account</a></button>
        <button><a href="logout.php">Logout</a></button>
    </div>

    <!-- Passmate instruction -->
    <p>your under in passmate guideline and <a href="#">term&condition</a> and <a href="#">privacy policy</a>..</p>
    <p>Thanks, <?php echo $user ?></p>

</div>



<?php

include("../hf/footer.php");

?>