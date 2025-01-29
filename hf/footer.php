<!-- PHP SCRIPT TO INSERT SUBSCRIPTION STATUS -->
<?php


if (isset($_POST['subscribe'])) {

    $email = $_POST['email'];
    $subscribe = 'subscribe';

    // Check Mail
    $checkmail = "select * from users where email = '$email'";
    $checkexu = mysqli_query($db, $checkmail);

    if (mysqli_num_rows($checkexu) > 0) {
        $subsql = "update users set subscription='$subscribe' where email='$email'";
        $subresult = mysqli_query($db, $subsql);
    } else {
        echo "<style> .footer-col .hidden_mail_subscribe { display:flex; } </style>";
    }

}


$fetchquery = "select subscription from users where email = '$user'";
$fetchres = mysqli_query($db, $fetchquery);
$fetchdata = mysqli_fetch_assoc($fetchres);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate </title>
</head>

<body>

    <!-- Footer Section -->
    <footer class="footer" id="footer">
        <div class="container_footer">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="#">About Passmate</a></li>
                        <li><a href="#">Contact Passmate</a></li>
                        <li><a href="#">Articles</a></li>
                        <li><a href="#">Investors</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">+91-932-586-0269</a></li>
                        <li><a href="#">campusconcerns@gmail.com</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Delivery</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Options</a></li>
                        <li><a href="#">Payment Options</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 class="logo">CampusCorner<span class="span_dot"></span></h4>
                    <p>Bonafide Certificates for College Students in Just a Few Clicks!</p><br>
                    <?php if (isset($_SESSION['logins'])) {
                        if ($fetchdata['subscription'] == 'subscribe') {
                            ?>
                            <p id="subscri_p">You are already subscribed to our newsletter</p>
                        <?php } else { ?>
                            <p id="subscri_p">The latest news , articles and resources sent your inbox weekly. Subscribe Now</p>
                            <!-- Subscribe Input Field -->
                            <form action="#" method="post">
                                <input type="email" name="email" placeholder="Enter email" value="<?php echo $user; ?>" readonly
                                    autocomplete="off" required>
                                <button name="subscribe">Subscribe</button>
                            </form>
                            <p class="hidden_mail_subscribe">Email Not Exist !</p>


                        <?php }
                    } else { ?>
                        <p id="subscri_p">You are not logged in. Please <a href="../users/login.php">login</a> to subscribe to</p>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="copy">
            Copyright © 2024 | All Right Reserved
        </div>
    </footer>


    <!-- Javascript file links Here -->



    <script src="../js/script.js"></script>




    <!-- Javascrip file link Here -->

</body>

</html>