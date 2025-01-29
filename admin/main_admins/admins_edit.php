<?php

include("main_adminpanel.php");

$sql = "select * from admins";
$admins = mysqli_query($db, $sql);


if (isset($_REQUEST['edt'])) {
    $id = $_REQUEST['edt'];
    $sql = "select * from admins where admin_id = '$id'";
    $a = mysqli_query($db, $sql);
    $vk = mysqli_fetch_array($a);
}


if (isset($_REQUEST['update_admin'])) {
    // $id = $_REQUEST['admin_id'];
    $name = $_REQUEST['admin_username'];
    $pass = $_REQUEST['admin_pass'];

    $sql = "update admins set admin_username='$name' , admin_pass='$pass' where admin_id = '$id'";
    mysqli_query($db, $sql);
    header("location:admins.php");
}



?>



<!-- Title -->
<h4> Update Admins </h4>


<!-- Update Form OF Admins -->
<div class="update_admin_form">
    <i class='bx bxs-x-circle' id="update_close_form"></i>
    <h4>Update Admin</h4>
    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <input type="text" placeholder="New Username" id="username" name="admin_username"
            value="<?php echo $vk['admin_username']; ?>">
        <div class="error-message" id="usernameError"></div>
        <input type="text" placeholder="Create Password" id="password" name="admin_pass"
            value="<?php echo $vk['admin_pass'] ?>">
        <div class="error-message" id="passwordError"></div>
        <button type="submit" name="update_admin">Update Admin</button>
    </form>
</div>

</div>
<!-- Main Content OF Right Bar -->

</div>

<!-- Admin Data Submit PHP code -->

<!-- Form  -->



<!-- Javascript file link here -->


<script src="script.js"></script>
