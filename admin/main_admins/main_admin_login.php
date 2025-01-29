<?php

include("../db.php");
session_start();



if (isset($_POST['main_login'])) {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_pass'];
    $sql = "select * from admins where admin_username='$username' and admin_pass='$password'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)) {
        $_SESSION['main_logins'] = $username;
        echo "<h1>Login Successfully</h1>";
        header("location:dashboard.php");
    } else {
        echo "
        <h1>Login Failed | Data Dose'nt match</h1>";

        $redirectUrl = "main_admin_login.php";
        $timeout = 500;

    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Main Admin </title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <style>
        a {
            transition: all ease 0.2s;
            width: 100%;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-content: center;
            color: black;
        }

        a:hover {
            background: black;
            color: white;
        }
    </style>

    <!-- Body content Here -->
    <div class="form_container">
        <h3>Pass<span>Mate</span></h3>
        <form action="#" method="post" autocomplete="off">
            <input type="text" name="admin_username" placeholder="Username" required>
            <input type="text" name="admin_pass" placeholder="Password" required>
            <button class="login" name="main_login">Login</button>
            <a href="../sir_admins/login_admin.php">Sir Admins</a>
        </form>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "<?php echo $redirectUrl; ?>";
        }, <?php echo $timeout; ?>);
    </script>


</body>

</html>