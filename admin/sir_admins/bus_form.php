<?php

include("panel.php");

$sql = "select * from bus_forms where status = 'pending'";
$bus = mysqli_query($db, $sql);

if (isset($_REQUEST['yes'])) {
    $train_form_id = $_REQUEST['train_form_id'];
    $bus_form_id = $_REQUEST['bus_form_id'];
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
    $profile_pic = $_REQUEST['profile_pic'];
    $adhar = $_REQUEST['adhar_card'];
    $fees = $_REQUEST['fees_receipt'];
    $ration_card = $_REQUEST['ration_card'];
    $i_card = $_REQUEST['i_card'];
    $sign = $_REQUEST['signature'];


    mysqli_query($db, "insert into complets_train_forms(train_form_id,bus_form_id,full_name,phone,email,dob,age,cast,address,sem,department,gender,departure,destination,months,profile_pic,adhar_card,fees_receipt,i_card,ration_card,signature,status) values('$train_form_id','$bus_form_id','$full_name','$phone','$email','$dob','$age','$cast','$address','$sem','$department','$gender','$departure','$destination','$months','$profile_pic','$adhar','$fees','$i_card','$ration_card','$sign','success')");

    mysqli_query($db, "delete from bus_forms where bus_form_id = '$bus_form_id'");

    // Delete From Train Form Data

    header("location:bus_form.php");
}


if (isset($_REQUEST['delC'])) {
    $id = $_REQUEST['delC'];
    $sql = "delete from bus_forms where bus_form_id = '$id'";
    mysqli_query($db, $sql);
    header("location:bus_form.php");
}

?>


<style>
    table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }
</style>

<!-- Title -->
<h4>Bus Applications</h4>

<?php

if (mysqli_num_rows($bus) > 0) {

    ?>
    <!-- Form Tables -->
    <table>
        <tr>
            <th>No</th>
            <th>Student Detail</th>
            <th>Document</th>
            <th>From</th>
            <th>To</th>
            <th>Months</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($bus)) {
            ?>
            <tr>
                <td><?php echo $row['bus_form_id']; ?></td>
                <td id="std_dtl">Name : <?php echo $row['full_name']; ?> <br>
                    Age : <?php echo $row['age']; ?> year old <br>
                    Email : <?php echo $row['email']; ?> <br>
                    Phone : <?php echo $row['phone']; ?>
                </td>
                <td><a href="busdocx.php?packs=<?php echo $row['bus_form_id']; ?>"><i class='bx bxs-file' id="docx"></i></a>
                </td>
                <td><?php echo $row['departure']; ?></td>
                <td><?php echo $row['destination']; ?></td>
                <td><?php echo $row['months']; ?></td>
                <td id="action"><a href="bus_remark.php?remark=<?php echo $row['bus_form_id']; ?>"><i
                            class='bx bx-question-mark'></i></a>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <!-- Data -->
                        <input type="text" name="train_form_id" value="0" hidden>
                        <input type="text" name="bus_form_id" value="<?php echo $row['bus_form_id']; ?>" hidden>
                        <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" hidden>
                        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" hidden>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" hidden>
                        <input type="text" name="dob" value="<?php echo $row['dob']; ?>" hidden>
                        <input type="text" name="age" value="<?php echo $row['age']; ?>" hidden>
                        <input type="text" name="cast" value="<?php echo $row['cast']; ?>" hidden>
                        <input type="text" name="address" value="<?php echo $row['address']; ?>" hidden>
                        <input type="text" name="sem" value="<?php echo $row['sem']; ?>" hidden>
                        <input type="text" name="department" value="<?php echo $row['department']; ?>" hidden>
                        <input type="text" name="gender" value="<?php echo $row['gender']; ?>" hidden>
                        <input type="text" name="departure" value="<?php echo $row['departure']; ?>" hidden>
                        <input type="text" name="destination" value="<?php echo $row['destination']; ?>" hidden>
                        <input type="text" name="months" value="<?php echo $row['months']; ?>" hidden>
                        <input type="text" name="profile_pic" value="<?php echo $row['profile_pic']; ?>" hidden>
                        <input type="text" name="adhar_card" value="<?php echo $row['adhar_card']; ?>" hidden>
                        <input type="text" name="fees_receipt" value="<?php echo $row['fees_receipt']; ?>" hidden>
                        <input type="text" name="i_card" value="<?php echo $row['i_card']; ?>" hidden>
                        <input type="text" name="signature" value="<?php echo $row['signature']; ?>" hidden>

                        <button name="yes"><a href="#" class="submit_data"><i class='bx bx-check'></i></a></button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php

} else { ?>
    <p>Application Not Found</p>

<?php } ?>




</div>
<!-- Main Content OF Right Bar -->

</div>


<!-- Javascript file link here -->

</body>

</html>