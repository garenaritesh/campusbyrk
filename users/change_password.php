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
        <form action="forgat_send.php" method="post">
            <input type="email" name="email" value="" placeholder="Email" required>
            <input type="text" name="subject" value="Your password" hidden>
            <div class="desc">
                <p>We are sending the link on email for change your password , click on link and redirect the page..</p>
            </div>
            <button type="submit" id="login_btn" name="change_password">Send Mail</button>
        </form>

    </div>


</body>

</html>