<?php



include("../hf/pages.php");

$sql = "select * from users where email='$user'";
$cuser = mysqli_query($db, $sql);
$user_data = mysqli_fetch_assoc($cuser);

// Remakr Details OF User
if (isset($_REQUEST['update_form'])) {
    $id = $_REQUEST['update_form'];
    $sql = "select * from bus_forms where bus_form_id = '$id'";
    $res = mysqli_query($db, $sql);
    $vk = mysqli_fetch_assoc($res);
}

// Check Erro In Which Information

// For Gender Checking 
// For Contact Detail Check Is Yes OR No
$getchecked = mysqli_fetch_array(mysqli_query($db, "select * from bus_forms where bus_form_id = '$id'"));
$value = $getchecked['gender'];
$checkedmc = ($value === 'M') ? 'checked' : '';
$checkedfc = ($value === 'F') ? 'checked' : '';
$checkedoc = ($value === 'O') ? 'checked' : '';


if (isset($_REQUEST['update_application'])) {

    $full_name = $_REQUEST['full_name'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $dob = $_REQUEST['dob'];
    $age = $_REQUEST['age'];
    $cast = $_REQUEST['cast'];
    $address = $_REQUEST['address'];
    $sem = $_REQUEST['sem'];
    $department = $_REQUEST['department'];
    $gender = $_REQUEST['gender'];
    $departure = $_REQUEST['departure'];
    $destination = $_REQUEST['destination'];
    $months = $_REQUEST['months'];

    // Logic for Profile Picture
    if (!empty($_FILES['profile_pic']['name'])) {
        $profile_pic = $_FILES['profile_pic']['name'];
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../admin/images/' . $profile_pic);
    } else {
        $profile_pic = $vk['profile_pic'];
    }

    // Logic for Aadhar Card
    if (!empty($_FILES['adhar_card']['name'])) {
        $adhar = $_FILES['adhar_card']['name'];
        move_uploaded_file($_FILES['adhar_card']['tmp_name'], '../admin/images/' . $adhar);
    } else {
        $adhar = $vk['adhar_card'];
    }

    // Logic for Fees Receipt
    if (!empty($_FILES['fees_receipt']['name'])) {
        $fees = $_FILES['fees_receipt']['name'];
        move_uploaded_file($_FILES['fees_receipt']['tmp_name'], '../admin/images/' . $fees);
    } else {
        $fees = $vk['fees_receipt'];
    }

    // Logic for I-Card
    if (!empty($_FILES['i_card']['name'])) {
        $i_card = $_FILES['i_card']['name'];
        move_uploaded_file($_FILES['i_card']['tmp_name'], '../admin/images/' . $i_card);
    } else {
        $i_card = $vk['i_card'];
    }

    // Logic for Ration_Cards
    if (!empty($_FILES['rationcard']['name'])) {
        $rationcard = $_FILES['rationcard']['name'];
        move_uploaded_file($_FILES['rationcard']['tmp_name'], '../admin/images/' . $rationcard);
    } else {
        $rationcard = $vk['rationcard'];
    }


    // Logic for Signature
    if (!empty($_FILES['signature']['name'])) {
        $sign = $_FILES['signature']['name'];
        move_uploaded_file($_FILES['signature']['tmp_name'], '../admin/images/' . $sign);
    } else {
        $sign = $vk['signature'];
    }

    $sql = "UPDATE bus_forms SET 
                full_name='$full_name', 
                phone='$phone', 
                email='$email', 
                dob='$dob', 
                age='$age', 
                cast='$cast', 
                address='$address', 
                sem='$sem', 
                department='$department', 
                gender='$gender', 
                departure='$departure', 
                destination='$destination', 
                months='$months', 
                profile_pic='$profile_pic', 
                adhar_card='$adhar', 
                fees_receipt='$fees', 
                i_card='$i_card', 
                rationcard='$rationcard',
                signature='$sign', 
                status='pending' 
            WHERE bus_form_id = '$id'";

    mysqli_query($db, $sql);

    // Remove related notifications
    $notifi_form_id = $vk['bus_form_id'];
    mysqli_query($db, "DELETE FROM notification WHERE form_id = '$notifi_form_id'");

    header("location:../users/notification.php");
}

// Read Dropdown Data
$user_email = $user;
$user_query = "select * from bus_forms where email = '$user_email'";
$user_res = mysqli_query($db, $user_query);
$user_data = mysqli_fetch_assoc($user_res);


$casts = ['open', 'obc', 'sc/st'];
$sems = ['1', '2', '3', '4', '5', '6', '7', '8'];
$dep = ['Civin', 'Mechanical', 'Plastic', 'Chemical', 'I.T'];
$duration = ['3', '6', '12'];

// <!-- notification from remark things -->
$form_ids = $vk['bus_form_id'];
$remark_query = "select * from notification where form_id = '$form_ids'";
$remark_res = mysqli_query($db, $remark_query);
$remark_data = mysqli_fetch_assoc($remark_res);

?>

<!-- notification from remark things -->



<!-- Body Content Here -->

<!-- Nav -->

<style>
    .forms .identy_dtl .document {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        justify-content: center;
    }

    .forms .identy_dtl .document input {
        display: flex;
    }
</style>




<div class="forms">
    <h4 class="forms_tit">Bus ( <i class='bx bx-bus'></i> )Application </h4>
    <p id="remark_info">Change This information Only [ <?php echo $remark_data['remark']; ?> ]</p>
    <form action="#" method="post" enctype="multipart/form-data">
        <p class="section_tit">Personal Details</p>
        <div class="personal_dtl">
            <div class="form_group">
                <input type="text" name="full_name" value="<?php echo $vk['full_name']; ?>" required>
                <div class="labelline">Full Name</div>
            </div>
            <div class="form_group">
                <input type="date" name="dob" id="dob" value="<?php echo $vk['dob']; ?>" required>
                <div class="labelline">DateOfBirth</div>
            </div>
            <div class="form_group">
                <input type="text" name="age" id="age" placeholder="Enter DOB" value="<?php echo $vk['age']; ?>"
                    required>

            </div>
            <!-- Email -->

            <input type="hidden" name="email" value="<?php echo $user; ?>" hidden readonly required>



            <input type="hidden" name="phone" value="<?php echo $user_data['phone']; ?>" hidden readonly required>

            <div class="form_group">
                <select id="cast" name="cast" required>
                    <!-- <option value="">Select Category</option> -->
                    <?php
                    $user_cast = $user_data['cast'];
                    // Loop through predefined casts
                    foreach ($casts as $cast) {
                        $selected = ($cast == $user_cast) ? 'selected' : '';
                        echo "<option value='$cast' $selected>$cast</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form_group">
                <select name="sem" required>
                    <?php
                    $user_sem = $user_data['sem'];
                    // Loop through predefined casts
                    foreach ($sems as $sem) {
                        $selected = ($sem == $user_sem) ? 'selected' : '';
                        echo "<option value='$sem' $selected>sem $sem</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="form_group">
                <select name="department" required>
                    <?php
                    $user_dep = $user_data['department'];
                    // Loop through predefined casts
                    foreach ($dep as $deps) {
                        $selected = ($deps == $user_dep) ? 'selected' : '';
                        echo "<option value='$deps' $selected>$deps Eng.</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form_group">
                <input type="text" id="departure" name="departure" value="<?php echo $vk['departure']; ?>" required>
                <div class="labelline">Departure</div>
            </div>

            <div class="form_group" id="transpert">
                <i class='bx bx-transfer-alt'></i>
            </div>

            <div class="form_group">
                <input type="text" id="destination" name="destination" value="<?php echo $vk['destination']; ?>"
                    required>
                <div class="labelline">Destination City</div>
            </div>

            <div class="form_group">
                <select name="months" required>
                    <?php
                    $user_duration = $user_data['months'];
                    // Loop through predefined casts
                    foreach ($duration as $dur) {
                        $selected = ($dur == $user_duration) ? 'selected' : '';
                        echo "<option value='$dur' $selected>$dur Months</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form_group">
                <input type="text" name="address" value="<?php echo $vk['address']; ?>" required>
                <div class="labelline">Address</div>

            </div>


            <div class="form_group">
                <label for="gender">Gender :</label>
                <div class="select_gen">
                    <div class="gen">
                        <p>Male</p>
                        <input type="radio" id="gender" name="gender" value="M" <?php echo $checkedmc; ?> required>
                    </div>
                    <div class="gen">
                        <p>Female</p>
                        <input type="radio" id="gender" name="gender" value="F" <?php echo $checkedfc; ?> required>
                    </div>
                    <div class="gen">
                        <p>Other</p>
                        <input type="radio" id="gender" name="gender" value="O" <?php echo $checkedoc; ?> required>
                    </div>
                </div>
            </div>

        </div>
        <!-- Identy Forms -->
        <p class="section_tit">Identiy Details</p>
        <div class="identy_dtl">
            <div class="document">
                <label for="profilePic">
                    <img src="../admin/images/<?php echo $vk['profile_pic']; ?>">
                    <p>Profile Picture</p>
                </label>
                <input type="file" value="<?php echo $vk['profile_pic']; ?>" name="profile_pic">
            </div>
            <div class="document">
                <label for="aadharCard">
                    <img src="../admin/images/<?php echo $vk['adhar_card']; ?>">
                    <p>Aadhar Card</p>
                </label>
                <input type="file" name="adhar_card" value="<?php echo $vk['adhar_card']; ?>">
            </div>
            <div class="document">
                <label for="feesReceipt">
                    <img src="../admin/images/<?php echo $vk['fees_receipt']; ?>">
                    <p>Fees Receipt</p>
                </label>
                <input type="file" value="<?php echo $vk['fees_receipt']; ?>" name="fees_receipt">
            </div>
            <div class="document">
                <label for="iCard">
                    <img src="../admin/images/<?php echo $vk['i_card']; ?>">
                    <p>I-Card</p>
                </label>
                <input type="file" name="i_card" value="<?php echo $vk['i_card']; ?>">
            </div>
            <div class="document">
                <label for="RationCard">
                    <img src="../admin/images/<?php echo $vk['rationcard']; ?>">
                    <p>Ration-Card</p>
                </label>
                <input type="file" name="rationcard" value="<?php echo $vk['rationcard']; ?>">
            </div>
            <div class="document">
                <label for="Signature">
                    <img src="../admin/images/<?php echo $vk['signature']; ?>">
                    <p>Signature</p>
                </label>
                <input type="file" name="signature" value="<?php echo $vk['signature']; ?>">
            </div>
        </div>

        <!-- Submitted Buttons -->
        <button name="update_application" type="submit">Submit<i class='bx bx-chevron-right'></i></button>

    </form>
</div>


<!-- For Train Pass Application Script -->
<script>
    document.getElementById('dob').addEventListener('change', function () {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) { age--; }
        document.getElementById('age').value = age;
    });


</script>



<!-- Our Missions Script -->


<script src="../js/script.js"></script>


<?php

include("../hf/footer.php");


?>