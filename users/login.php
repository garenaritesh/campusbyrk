<!-- Login Proccess Through Database -->


<?php

include("../admin/db.php");

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)) {
        $_SESSION['logins'] = $email;
        echo "<h1>Login Successfully</h1>";
        header("location:../pages/index.php");
    } else {
        echo "
        <h1>Login Failed | Data Dose'nt match</h1>";

        $redirectUrl = "login.php";
        $timeout = 500;

    }
}

if (isset($_REQUEST['check_email'])) {
    $email = $_REQUEST['check_email'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $found = mysqli_num_rows($result);
    $user_email = $found;
    echo $user_email;

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login | PassMate </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Body Content Here -->
    <div class="container">
        <h3>Campus<span>Corner</span></h3>
        <form action="#" method="post" autocomplete="off">
            <input type="text" name="email" placeholder="Email" required autocomplete="off">
            <input type="text" name="password" placeholder="Password" required>
            <button type="submit" id="login_btn" name="login">Login</button>
            <div class="desc">
                <p>Don't have an account? <a href="signup.php">Create account</a></p>
                <p><a href="forgot_password.php">forgot password?</a></p>
            </div>
        </form>
    </div>



    <!-- Javascript file link here -->

    <script>
        setTimeout(() => {
            window.location.href = "<?php echo $redirectUrl; ?>";
        }, <?php echo $timeout; ?>);
    </script>

</body>

</html>