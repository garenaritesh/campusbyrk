<?php

include("../hf/users_h.php");

// Notification Data Read

$sql = "select * from notification";
$res = mysqli_query($db, $sql);


// User Details

$user_data = mysqli_fetch_assoc(mysqli_query($db, "select * from users where email = '$user'"));

$getchecked = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
$value = $getchecked['gender'];
$checkedmc = ($value === 'M') ? 'checked' : '';
$checkedfc = ($value === 'F') ? 'checked' : '';
$checkedoc = ($value === 'O') ? 'checked' : '';

// Update Information Query
if (isset($_REQUEST['change_info'])) {

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $gender = $_REQUEST['gender'];
    $phone = $_REQUEST['phone'];
    $dob = $_REQUEST['birthdate'];
    $user_pic = $_REQUEST['user_pic'];

    mysqli_query($db, "update users set name='$name',gender='$gender',phone='$phone',birthdate='$dob' where email = '$user'");
    header("location:user_info.php");

}

// User Data
$sql = "select * from users where email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql));

?>
<!-- 
<style>
    .container form input {
        background: #fafafa;
        cursor: no-drop;
    }

    .container form input::selection {
        display: none;
    }



    #update_info {
        display: none;
    }

    #delete_account {
        position: absolute;
        color: red;
        top: 85%;
        left: 3%;
        font-size: 16px;
        font-weight: 600;

    }
</style> -->

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
        <li class="c_tab"><a href="user_info.php">Account</a></li>
        <li><a href="notification.php">Notification</a></li>
        <li><a href="setting.php">Setting</a></li>
    </ul>
</div>

<!-- Personal Information -->

<!-- User Personal Details -->
<section class="container">
    <a href="#" id="user_edt"><i class='bx bxs-edit'></i></a>
    <div id="cls_update_form"><i class='bx bxl-xing'></i></div>
    <header>Personal Information</header>
    <form action="#" class="form" id="none_form">
        <div class="input-box">
            <label>Full Name</label>
            <?php
            if ($user_data['name'] == '') {
                ?>
                <input type="text" name="name" class="myInput" id="full_name" placeholder="Enter full name"
                    value="Please Edit Full Name" readonly />
            <?php } else { ?>
                <input type="text" class="myInput" name="name" id="full_name" placeholder="Enter full name"
                    value="<?php echo $user_data['name']; ?>" readonly />
            <?php } ?>
        </div>
        <div class="input-box">
            <label>Email Address</label>
            <?php
            if ($user_data['email'] == '') {
                ?>
                <input type="text" class="myInput" name="email" placeholder="Enter full name" value="Update Email"
                    readonly />
            <?php } else { ?>
                <input type="text" class="myInput" name="email" placeholder="Enter email address"
                    value="<?php echo $user_data['email']; ?>" readonly />
            <?php } ?>

        </div>
        <div class="column">
            <div class="input-box">
                <label>Phone Number</label>
                <?php
                if ($user_data['phone'] == '') {
                    ?>
                    <input type="text" class="myInput" name="phone" placeholder="Enter full name"
                        value="Please Edit Phone number" readonly />
                <?php } else { ?>
                    <input type="text" class="myInput" name="phone" placeholder="DOB"
                        value="<?php echo $user_data['phone']; ?>" readonly />
                <?php } ?>
            </div>
            <div class="input-box">
                <label>Birth Date</label>
                <?php
                if ($user_data['birthdate'] == '') {
                    ?>
                    <input type="text" class="myInput" name="birthdate" placeholder="Enter full name"
                        value="Please Edit DOB" readonly />
                <?php } else { ?>
                    <input type="text" class="myInput" name="birthdate" placeholder="DOB"
                        value="<?php echo $user_data['birthdate']; ?>" readonly />
                <?php } ?>

            </div>
        </div>
        <div class="gender-box">
            <h3>Gender</h3>
            <div class="gender-option">
                <div class="gender">
                    <input type="radio" id="check-male" value="M" name="gender" readonly <?php echo $checkedmc; ?> />
                    <label for="check-male">male</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-female" value="F" name="gender" readonly <?php echo $checkedfc; ?> />
                    <label for="check-female">Female</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-other" value="O" name="gender" readonly <?php echo $checkedoc; ?> />
                    <label for="check-other">prefer not to say</label>
                </div>
            </div>
        </div>
    </form>

    <!-- change Form -->
    <form action="#" class="form" id="change_form" method="post" enctype="multipart/form-data">
        <div class="input-box">
            <label>Full Name</label>
            <input type="text" class="myInput" name="name" id="full_name" placeholder="Enter full name"
                value="<?php echo $user_data['name']; ?>" />
        </div>
        <div class="input-box">
            <label>Email Address</label>
            <input type="text" class="myInput" name="email" placeholder="Updtae Email" value="<?php echo $user; ?>" />
        </div>
        <div class="column">
            <div class="input-box">
                <label>Phone Number</label>
                <input type="text" class="myInput" name="phone" placeholder="DOB"
                    value="<?php echo $user_data['phone']; ?>">
            </div>
            <div class="input-box">
                <label>Birth Date</label>
                <input type="date" class="myInput" name="birthdate" value="<?php echo $user_data['birthdate']; ?>" />
            </div>
        </div>
        <div class="gender-box">
            <h3>Gender</h3>
            <div class="gender-option">
                <div class="gender">
                    <input type="radio" id="check-male" value="M" name="gender" <?php echo $checkedmc; ?> />
                    <label for="check-male">male</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-female" value="F" name="gender" <?php echo $checkedfc; ?> />
                    <label for="check-female">Female</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-other" value="O" name="gender" <?php echo $checkedoc; ?> />
                    <label for="check-other">prefer not to say</label>
                </div>
            </div>
        </div>



        <button name="change_info">Save</button>
    </form>

    <!-- FOQ Section -->
    <div class="foq">
        <h2 class="title">FAQs</h2>
        <div class="desclaimer">
            <p class="desc_tit">What happens when I update my email address (or mobile number)?</p>
            <p>Your login email id (or mobile number) changes, likewise. You'll receive all your account related
                communication on your updated email address (or mobile number).</p>
        </div>
        <div class="desclaimer">
            <p class="desc_tit">When will my Flipkart account be updated with the new email address (or mobile number)?
            </p>
            <p>It happens as soon as you confirm the verification code sent to your email (or mobile) and save the
                changes.</p>
        </div>
        <div class="desclaimer">
            <p class="desc_tit">What happens to my existing Flipkart account when I update my email address (or mobile
                number)?</p>
            <p>Updating your email address (or mobile number) doesn't invalidate your account. Your account remains
                fully functional. You'll continue seeing your Order history, saved information and personal details.</p>
        </div>
        <div class="desclaimer">
            <p class="desc_tit">Does my Seller account get affected when I update my email address?</p>
            <p>Flipkart has a 'single sign-on' policy. Any changes will reflect in your Seller account also.</p>
        </div>
    </div>

    <div class="user_footer">
        <img src="../admin/assets/account_footer.png" alt="">
    </div>

    <!-- Delete Account Button Here -->
    <a href="delete_account.php" id="delete_account" style="text-decoration: none;">Delete Account</a>

</section>




<?php

include("../hf/footer.php");

?>