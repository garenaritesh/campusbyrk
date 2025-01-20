

<?php

include("../admin/db.php");

if (isset($_REQUEST['update_pass'])) {
    $id = $_REQUEST['update_pass'];
    $sql = "select * from users where user_id = '$id'";
    $res = mysqli_query($db, $sql);
    $vk = mysqli_fetch_assoc($res);
}

if(isset($_REQUEST['newpass'])){
    $password = $_REQUEST['password'];

    $sql = "update users set password='$password' where user_id='$id'";
    mysqli_query($db,$sql);
    header("Location: login.php");

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Forgat Password </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Forgat Password system create here by me -->

    <div class="container">
        <h3>Pass<span>Mate</span></h3>
        <form action="#" method="post">
            <input type="email" name="email" value="<?php echo $vk['email'];?>" placeholder="Email" required readonly>
            <input type="text" name="password" value="<?php echo $vk['password'];?>" readonly>
            <input type="text" name="normal" placeholder="New Password" required>
            <input type="password" name="password" placeholder="Confirm Password" required>
            <button type="submit" id="login_btn" name="newpass">Change Password</button>
        </form>

    </div>


</body>

</html>