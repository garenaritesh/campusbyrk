<?php

include("main_adminpanel.php");


$sql = "select * from admins";
$admins = mysqli_query($db, $sql);


if (isset($_REQUEST['delC'])) {
    $id = $_REQUEST['delC'];
    $sql = "delete from admins where admin_id = '$id'";
    mysqli_query($db, $sql);
    header("location:admins.php");
}




if (isset($_REQUEST['add_admin'])) {

    $username = $_REQUEST['admin_username'];
    $password = $_REQUEST['admin_pass'];

    mysqli_query($db, "insert into admins(admin_username,admin_pass) values('$username','$password')");
    header("location:admins.php");

}




?>




<!-- Title -->
<h4> Admins </h4>

<div class="add_admin" id="admin_form">Add</div>

<!-- Form Tables -->
<table>
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($admins)) {
        ?>
        <tr>
            <td><?php echo $row['admin_id']; ?></td>
            <td><?php echo $row['admin_username']; ?></td>
            <td><?php echo $row['admin_pass']; ?></td>
            <td id="action"> <button name="edit_admin"><a href="admins_edit.php?edt=<?php echo $row['admin_id']; ?>"
                        id="open_updateform" class="edit_data">
                        <i class='bx bxs-pencil'></i></a></button><a href="admins.php?delC=<?php echo $row['admin_id']; ?>"
                    class="del_data"><i class='bx bx-x'></i></a>


            </td>
        </tr>

        <?php
    } ?>

</table>


</div>
<!-- Main Content OF Right Bar -->

</div>

<!-- Admin Data Submit PHP code -->

<!-- Form  -->

<div class="admin_form">
    <i class='bx bxs-x-circle' id="close_form"></i>
    <h4>Admin</h4>
    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <input type="text" placeholder="New Username" id="username" name="admin_username">
        <div class="error-message" id="usernameError"></div>
        <input type="text" placeholder="Create Password" id="password" name="admin_pass">
        <div class="error-message" id="passwordError"></div>
        <button type="submit" name="add_admin">Add Admin</button>
    </form>
</div>


<!-- Javascript file link here -->


<script src="script.js"></script>

</body>

</html>