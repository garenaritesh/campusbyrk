<?php

include("db.php");
session_start();



if (isset($_POST['login'])) {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_pass'];
    $sql = "select * from admins where admin_username='$username' and admin_pass='$password'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)) {
        $_SESSION['login'] = $username;
        echo "<h1>Login Successfully</h1>";
        header("location:train_form.php");
    } else {
        echo "
        <h1>Login Failed | Data Dose'nt match</h1>";

        $redirectUrl = "login_admin.php";
        $timeout = 2000;

    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Admin </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Body content Here -->
    <div class="form_container">
        <h3>Pass<span>Mate</span></h3>
        <form action="#" method="post">
            <input type="text" name="admin_username" placeholder="Username">
            <input type="text" name="admin_pass" placeholder="Password">
            <button class="login" name="login">Login</button>
        </form>
    </div>

</body>

</html>