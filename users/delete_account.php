<!-- PHP Setting Here -->
<?php

include("../admin/db.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$user = $_SESSION['logins'];

$sql = "select * from users where email = '$user'";
$user_data = mysqli_fetch_assoc(mysqli_query($db, $sql));

if (isset($_REQUEST['proccess'])) {

    $user_id = $_REQUEST['user_id'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $reason = $_REQUEST['reason'];
    // $status = $_REQUEST['status'];

    mysqli_query($db, "insert into delete_procceses(user_id,email,phone,reason) values('$user_id','$email','$phone','$reason')");
    header("location:delete_account.php");


    $email = $_POST['email'];

    // Main Script OF PHP Very Secure Code Here
    // Don't Change without give permission

    $sql = "select * from users where email = '$email'";
    $res = mysqli_query($db, $sql);
    $check_email = mysqli_num_rows($res);
    $email_data = mysqli_fetch_assoc($res);

    if ($check_email > 0) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'passmatestudentcare@gmail.com';
        $mail->Password = 'yajncncenlhsalxs'; // Your Gmail Password Of Sending Email Id Or Account
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('passmatestudentcare@gmail.com');
        $mail->addAddress($_POST['email']); // Add a recipient

        $mail->isHTML(true);

        $mail->Subject = $_POST['subject'];
        $mail->Body = "Your detailes has been successfully submitted. Thanks <br> 
        our team contact soon to proccess of your passmate account delete 7 or 14 working days there are no longer to use.
        Greting Day";
        $mail->send();

        echo "
        <script>alert('Send Mail successFully');
          document.location.href = 'setting.php'</script>
    
         ";
    } else {
        echo "<script>
              alert('Email Not Exist');

              window.location.href = 'delete_account.php';
              </script>
           ";
    }



}

// Check The Application

$sql = "select * from delete_procceses where email = '$user'";
$check_app = mysqli_num_rows(mysqli_query($db, $sql));

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 90%;
        max-width: 600px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        position: relative;
        padding: 20px 30px;
        text-align: left;
    }

    #back_btn {

        position: absolute;
        top: 5%;
        right: 2%;
        font-size: 25px;
        font-weight: 600;
        color: black;
        transition: all ease 0.2s;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    #back_btn:hover {

        background: #EEEEEE;
        border-radius: 50%;

    }


    .container .popup {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.2rem;
        flex-direction: column;
    }

    .container .popup img {
        width: 200px;

    }

    .card textarea {
        width: 100%;
        resize: none;
        padding: 10px;
        border: 1px solid #EEEEEE;
        outline: none;
    }

    .card h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .card p {
        font-size: 16px;
        color: #555;
        margin-bottom: 15px;
    }

    .card ul {
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .card ul li {
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .card a {
        color: #0073e6;
        text-decoration: none;
    }

    .card a:hover {
        text-decoration: underline;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .checkbox-container input {
        margin-right: 10px;
    }

    .checkbox-container label {
        font-size: 14px;
        color: #555;
    }

    .button-container {
        display: flex;
        justify-content: right;
        align-items: center;
        gap: 2rem;

    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: not-allowed;
        color: #fff;
        background-color: #ccc;
        transition: all 0.3s ease;
        background: black;
    }

    #cancel_btn {
        cursor: pointer;
    }

    #cancel_btn a {
        color: white;
        text-decoration: none;
    }


    button.enabled {
        background-color: #e53935;
        cursor: pointer;
    }

    button.enabled:hover {
        background-color: #d32f2f;
    }
</style>

<body>
    <div class="container">
        <!-- Already Procees Theme Notifi -->
        <?php
        if ($check_app > 0) {
            $sql = "select * from delete_procceses where email = '$user'";
            $check_data = mysqli_fetch_assoc(mysqli_query($db, $sql));
            if ($check_data['status'] == 'delete') {
                ?>
                <div class="popup">
                    <a href="setting.php" id="back_btn"><i class='bx bx-x'></i></a>
                    <img src="../admin/assets/delete_accounts.jpg" alt="">
                    <p>"🌟 Your journey with us doesn’t have to end here! 🚀 Stay connected for exclusive benefits and endless
                        opportunities. 💬 Reach out anytime—we're here to make your experience extraordinary! ❤️✨"</p>
                    <p>"Before you go, remember that this platform is here to make your journey seamless, enjoyable, and
                        rewarding. If you ever choose to return, we’ll be ready to welcome you back with open arms!"</p>

                </div>
                <?php
            } else { ?>
                <div class="popup">
                    <a href="setting.php" id="back_btn"><i class='bx bx-x'></i></a>
                    <img src="../admin/assets/delete_procss.png" alt="">
                    <p>Your detailes has been successfully submitted. Thanks</p>
                    <p>our team contact you to very soon to proccess of yoou account</p>
                    <p>your passmate account delete 7 or 14 working days there are no longer to use.</p>
                </div>
            <?php } ?>
            <?php
        } else {
            ?>
            <div class="card" id="card">
                <h1>Delete Your Passmate Profile</h1>
                <p>As a Paamate Member, you currently get:</p>
                <ul>
                    <li>Free returns on all orders</li>
                    <li>Express checkout every time you shop</li>
                    <li>A personal Wishlist to save items</li>
                    <li>Easy order tracking</li>
                    <li>Access to activity tracking via Nike Membership</li>
                </ul>
                <p>By deleting your profile:</p>
                <ul>
                    <li>You will no longer have access to your Nike.com or Nike Member profile.</li>
                    <li>
                        Information related to orders will be available by contacting
                        <a href="#">consumer services</a>.
                    </li>
                    <li>Your mobile app data will be accessible until you log out.</li>
                </ul>
                <form action="#" method="post">
                    <!-- <input type="text" name="status" value="process" hidden> -->
                    <input type="text" name="user_id" value="<?php echo $user_data['user_id']; ?>" c required hidden>
                    <input type="text" name="email" value="<?php echo $user; ?>" required hidden>
                    <input type="text" name="phone" value="<?php echo $user_data['phone']; ?>" required hidden>
                    <textarea name="reason" placeholder="Tell us ( reason ) " rows="5" required></textarea>
                    <div class="checkbox-container">
                        <input type="checkbox" id="confirm-delete" />
                        <label for="confirm-delete">I understand the consequences of deleting my profile.</label>
                    </div>
                    <div class="button-container">
                        <button id="delete-btn" name="proccess" disabled>Delete Account</button>
                        <button id="cancel_btn"><a href="setting.php">Cancel</a></button>
                    </div>
                </form>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Javascript content Here -->
    <script>
        const checkbox = document.getElementById('confirm-delete');
        const deleteBtn = document.getElementById('delete-btn');

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                deleteBtn.classList.add('enabled');
                deleteBtn.disabled = false;
                deleteBtn.style.cursor = 'pointer';
            } else {
                deleteBtn.classList.remove('enabled');
                deleteBtn.disabled = true;
                deleteBtn.style.cursor = 'not-allowed';
            }
        });

    </script>
</body>

</html>