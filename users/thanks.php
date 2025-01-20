<!-- Login Proccess Through Database -->


<?php

include("../admin/db.php");

session_start();


$redirectUrl = "login.php";
$timeout = 2000;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login | PassMate </title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Email Sending PLatform SMTP LINK CDN -->
    <!-- <script src="https://smtpjs.com/v3/smtp.js"> -->
    </script>


</head>

<body>

    <!-- Body Content Here -->
    <div class="container">
        <h3>Pass<span>Mate</span></h3>
        <form action="#">
            <h1>Check your Email..</h1>
            <p>We are send your password..</p>
        </form>
    </div>


    <script>
        setTimeout(() => {
            window.location.href = "<?php echo $redirectUrl; ?>";
        }, <?php echo $timeout; ?>);
    </script>

</body>

</html>