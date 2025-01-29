<?php

include("db.php");
session_start();

if (isset($_REQUEST['remark'])) {
    $packs = $_REQUEST['remark'];
    $sql = "select * from bus_forms where bus_form_id = '$packs'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Send Remark Msg TO User

if (isset($_REQUEST['bus_remark_send'])) {
    $email = $_REQUEST['user'];
    $msg = $_REQUEST['message'];
    $sender = $_REQUEST['sender'];
    $form_id = $_REQUEST['form_id'];
    $remark = $_REQUEST['remark'];
    $forms = $_REQUEST['forms'];
    $remarkString = implode(',', $remark);

    $sql1 = "insert into notification(user,message,sender,remark,form_id,forms) values('$email','$msg','$sender','$remarkString','$form_id','$forms')";
    $remark = mysqli_query($db, $sql1);



    $sql2 = "update bus_forms set status='Remark' where email = '$email' and bus_form_id='$form_id'";
    $status = mysqli_query($db, $sql2);
    header("location:bus_form.php");


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Remark Application </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Body Content Here -->
    <div class="remark_form">
        <h3>Remark Application</h3>



        <form action="#" method="post" enctype="multipart/form-data">
            <!-- Data -->
            <input type="text" name="form_id" value="<?php echo $row['bus_form_id']; ?>">
            <input type="text" name="user" value="<?php echo $row['email'] ?>" readonly>
            <input type="text" name="sender" value="FormAdmin" hidden>
            <input type="text" name="forms" value="bus" hidden readonly required>
            <!-- <input type="text" name="status" value="Remark"> -->
            <!-- which thing can edit by user that want by bonaifed sir  -->
            <!-- Things -->
            <h4>Documents</h4>
            <div class="remark_thing">
                <div class="things">
                    <label for="adhar">Adhar Card</label>
                    <input type="checkbox" name="remark[]" value="adhar_card">
                </div>
                <div class="things">
                    <label for="i_card">I-Card</label>
                    <input type="checkbox" name="remark[]" value="i_card">
                </div>
                <div class="things">
                    <label for="profile_pic">Profile Pic</label>
                    <input type="checkbox" name="remark[]" value="user_pic">
                </div>
                <div class="things">
                    <label for="signature">Signature</label>
                    <input type="checkbox" name="remark[]" value="sign">
                </div>
                <div class="things">
                    <label for="fees">Fees Receipt</label>
                    <input type="checkbox" name="remark[]" value="fees">
                </div>
            </div>

            <!-- For Student Detail Issue -->
            <h4>Student Details</h4>
            <div class="remark_thing">
                <div class="things">
                    <label for="full_name">Full Name</label>
                    <input type="checkbox" name="remark[]" value="full_name">
                </div>
                <div class="things">
                    <label for="dob">DOB</label>
                    <input type="checkbox" name="remark[]" value="dob">
                </div>
                <div class="things">
                    <label for="age">Age</label>
                    <input type="checkbox" name="remark[]" value="age">
                </div>
                <div class="things">
                    <label for="cast">Cast</label>
                    <input type="checkbox" name="remark[]" value="cast">
                </div>
                <div class="things">
                    <label for="Sem">Semester</label>
                    <input type="checkbox" name="remark[]" value="semester">
                </div>
                <div class="things">
                    <label for="department">Department</label>
                    <input type="checkbox" name="remark[]" value="department">
                </div>
                <div class="things">
                    <label for="gender">Gender</label>
                    <input type="checkbox" name="remark[]" value="gender">
                </div>
                <div class="things">
                    <label for="address">Address</label>
                    <input type="checkbox" name="remark[]" value="Address">
                </div>
                <div class="things">
                    <label for="departure">Departure City</label>
                    <input type="checkbox" name="remark[]" value="departure">
                </div>
                <div class="things">
                    <label for="destination">Destination City</label>
                    <input type="checkbox" name="remark[]" value="destination">
                </div>
                <div class="things">
                    <label for="PassDuration">Pass Duration</label>
                    <input type="checkbox" name="remark[]" value="month_duration">
                </div>

                <div class="things">
                    <label for="profile_pic">Profile Pic</label>
                    <input type="checkbox" name="remark[]" value="user_pic">
                </div>

            </div>

            <textarea name="message" id="remarkarea" rows="5" placeholder="Reply To User"></textarea>
            <button type="submit" name="bus_remark_send">Send</button>
        </form>

    </div>


    <!-- Javascript file link here -->



</body>

</html>