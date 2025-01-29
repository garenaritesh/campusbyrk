<?php

include("../hf/pages.php");

$sql = "select * from users where email='$user'";
$cuser = mysqli_query($db, $sql);
$user_data = mysqli_fetch_assoc($cuser);


if (isset($_REQUEST['submit'])) {

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

    $profile_pic = $_FILES['profile_pic']['name'];
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../admin/images/' . $profile_pic);

    $adhar = $_FILES['adhar_card']['name'];
    move_uploaded_file($_FILES['adhar_card']['tmp_name'], '../admin/images/' . $adhar);

    $fees = $_FILES['fees_receipt']['name'];
    move_uploaded_file($_FILES['fees_receipt']['tmp_name'], '../admin/images/' . $fees);

    $i_card = $_FILES['i_card']['name'];
    move_uploaded_file($_FILES['i_card']['tmp_name'], '../admin/images/' . $i_card);

    $sign = $_FILES['signature']['name'];
    move_uploaded_file($_FILES['signature']['tmp_name'], '../admin/images/' . $sign);

    mysqli_query($db, "insert into train_forms(full_name,phone,email,dob,age,cast,address,sem,department,gender,departure,destination,months,profile_pic,adhar_card,fees_receipt,i_card,signature,status) values('$full_name','$phone','$email','$dob','$age','$cast','$address','$sem','$department','$gender','$departure','$destination','$months','$profile_pic','$adhar','$fees','$i_card','$sign','pending')");
    header("location:user_account.php");


}


$from = isset($_POST['departure']) ? htmlspecialchars($_POST['departure']) : '';
$to = isset($_POST['destination']) ? htmlspecialchars($_POST['destination']) : '';
$selectedDuration = isset($_POST['months']) ? $_POST['months'] : '';

?>

<!-- Form -->



<div class="forms">
    <h4 class="forms_tit">Train ( <i class='bx bx-train'></i> ) Application</h4>
    <form action="#" method="post" enctype="multipart/form-data">
        <p class="section_tit">Personal Details</p>
        <div class="personal_dtl">
            <div class="form_group">
                <input type="text" name="full_name" required>
                <div class="labelline">Full Name</div>
            </div>
            <div class="form_group">
                <input type="date" name="dob" id="dob" required>
                <div class="labelline">DateOfBirth</div>
            </div>
            <div class="form_group">
                <input type="text" name="age" id="age" placeholder="Enter DOB" readonly required>

            </div>
            <!-- Email -->

            <input type="hidden" name="email" value="<?php echo $user; ?>" hidden readonly required>



            <input type="hidden" name="phone" value="<?php echo $user_data['phone']; ?>" hidden readonly required>

            <div class="form_group">
                <select id="cast" name="cast" required>
                    <option value="">Select Category</option>
                    <option value="OPEN">OPEN</option>
                    <option value="OBC">OBC</option>
                    <option value="SC/ST">SC/ST</option>
                </select>
            </div>
            <div class="form_group">
                <select id="months" name="sem" required>
                    <option value="">Select Semester</option>
                    <option value="1">Sem 1</option>
                    <option value="2">Sem 2</option>
                    <option value="3">Sem 3</option>
                    <option value="4">Sem 4</option>
                    <option value="5">Sem 5</option>
                    <option value="6">Sem 6</option>
                    <option value="7">Sem 7</option>
                    <option value="8">Sem 8</option>
                </select>
            </div>
            <div class="form_group">
                <select id="months" name="department" required>
                    <option value="">Select Department</option>
                    <option value="Civil">Civil Eng.</option>
                    <option value="Mechanical">Mechanical Eng.</option>
                    <option value="Plastic">Plastic Eng.</option>
                    <option value="Chemical">Chemical Eng.</option>
                    <option value="I.T">Information Technology</option>
                </select>
            </div>

            <div class="form_group">
                <input type="text" id="departure" name="departure" value="<?php echo $from; ?>" required>
                <div class="labelline">Departure</div>
            </div>

            <div class="form_group" id="transpert">
                <i class='bx bx-transfer-alt'></i>
            </div>

            <div class="form_group">
                <input type="text" id="destination" name="destination" value="<?php echo $to; ?>" required>
                <div class="labelline">Destination City</div>
            </div>

            <div class="form_group">
                <select id="months" name="months" required>
                    <option value="">Select duration</option>
                    <!-- <option value="1">1 Month</option> -->
                    <option value="3" <?php echo ($selectedDuration == '3') ? 'selected' : ''; ?>>3 Months</option>
                    <option value="6" <?php echo ($selectedDuration == '6') ? 'selected' : ''; ?>>6 Months</option>
                    <option value="12" <?php echo ($selectedDuration == '12') ? 'selected' : ''; ?>>12 Months</option>
                </select>
            </div>

            <div class="form_group">
                <input type="text" name="address" required>
                <div class="labelline">Address</div>

            </div>


            <div class="form_group">
                <label for="gender">Gender :</label>
                <div class="select_gen">
                    <div class="gen">
                        <p>Male</p>
                        <input type="radio" id="gender" name="gender" value="M" required>
                    </div>
                    <div class="gen">
                        <p>Female</p>
                        <input type="radio" id="gender" name="gender" value="F" required>
                    </div>
                    <div class="gen">
                        <p>Other</p>
                        <input type="radio" id="gender" name="gender" value="O" required>
                    </div>
                </div>
            </div>

        </div>
        <!-- Identy Forms -->
        <p class="section_tit">Identiy Details</p>
        <div class="identy_dtl">
            <div class="document">
                <label for="profilePic">
                    <img src="../admin/assets/upload_icon.png" alt="Profile Picture" id="profilePreview">
                    <p>Profile Picture</p>
                </label>
                <input type="file" id="profilePic" name="profile_pic" accept="image/*" required>
            </div>
            <div class="document">
                <label for="aadharCard">
                    <img src="../admin/assets/upload_icon.png" alt="Aadhar Card" id="aadharPreview">
                    <p>Aadhar Card</p>
                </label>
                <input type="file" name="adhar_card" id="aadharCard" accept="image/*" required>
            </div>
            <div class="document">
                <label for="feesReceipt">
                    <img src="../admin/assets/upload_icon.png" alt="Fees Receipt" id="receiptPreview">
                    <p>Fees Receipt</p>
                </label>
                <input type="file" id="feesReceipt" name="fees_receipt" accept="image/*" required>
            </div>
            <div class="document">
                <label for="iCard">
                    <img src="../admin/assets/upload_icon.png" alt="I-Card" id="iCardPreview">
                    <p>I-Card</p>
                </label>
                <input type="file" id="iCard" name="i_card" accept="image/*" required>
            </div>
            <div class="document">
                <label for="Signature">
                    <img src="../admin/assets/upload_icon.png" alt="Signature" id="SignaturePreview">
                    <p>Signature</p>
                </label>
                <input type="file" id="Signature" name="signature" accept="image/*" required>
            </div>
        </div>

        <!-- Submitted Buttons -->
        <button name="submit">Submit<i class='bx bx-chevron-right'></i></button>

    </form>
</div>

<!--  -->

<!-- Javascript content here -->

<!-- For Train Pass Application Script -->


<script>

    document.getElementById('dob').addEventListener('change', function () {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) { age--; }
        document.getElementById('age').value = age;
    }); const previewFile = (input, previewId) => {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };

    document.getElementById('profilePic').addEventListener('change', function () {
        previewFile(this, 'profilePreview');
    });
    document.getElementById('aadharCard').addEventListener('change', function () {
        previewFile(this, 'aadharPreview');
    });
    document.getElementById('feesReceipt').addEventListener('change', function () {
        previewFile(this, 'receiptPreview');
    });
    document.getElementById('iCard').addEventListener('change', function () {
        previewFile(this, 'iCardPreview');
    });
    document.getElementById('Signature').addEventListener('change', function () {
        previewFile(this, 'SignaturePreview');
    });

</script>






<?php

include("../hf/footer.php");

?>