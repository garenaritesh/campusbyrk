<?php

include("main_adminpanel.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';



$sql = "select * from delete_procceses where status = 'process'";
$del_res = mysqli_query($db, $sql);
$requests = mysqli_query($db, $sql);
$count_re = mysqli_num_rows($del_res);

if (isset($_REQUEST['del_ac'])) {

    $id = $_REQUEST['delete_id'];
    $email = $_REQUEST['email'];
    mysqli_query($db, "update delete_procceses set status='delete' where delete_id='$id'");



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

        $mail->Subject = 'Account Delete Request';
        $mail->Body = "Your Passmate Account delete succssfully from passmate , thanks our user to be part small journey with us". '<br>' .
            "🌟 Your journey with us doesn’t have to end here! 🚀 Stay connected for exclusive benefits and endless
                        opportunities. '<br>' 💬 Reach out anytime—we're here to make your experience extraordinary! ❤️✨" .
            "Before you go, remember that this platform is here to make your journey seamless, enjoyable, and
                        rewarding. If you ever choose to return, we’ll be ready to welcome you back with open arms!" .
            "Greting Day , Love you so much enjoy your journey.";
        $mail->send();

        echo "
        <script>alert('Send Mail successFully');
          document.location.href = 'delete_requests.php'</script>
    
         ";
    } else {
        echo "<script>
              alert('Email Not Exist');

              window.location.href = 'delete_requests.php';
              </script>
           ";
    }

}


?>





            <!-- Title -->
            <h4>Account Delete Requests</h4>

            <!-- Form Tables -->
            <table>
                <tr>
                    <th>No</th>
                    <th>User Details</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $status = mysqli_fetch_assoc($del_res);
                if ($count_re > 0) {
                    if ($status['status'] == 'process') {
                        while ($row = mysqli_fetch_array($requests)) {

                            ?>
                            <tr>
                                <td><?php echo $row['delete_id']; ?></td>
                                <td id="std_dtl">
                                    Email : <?php echo $row['email']; ?> <br>
                                    Phone : <?php echo $row['phone']; ?>
                                </td>
                                <td><?php echo $row['reason']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td id="action"><a href="#"><i class='bx bxs-phone-call'></i></a>
                                    <form action="#" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['delete_id'] ?>">
                                        <input type="hidden" name="email" value="<?php echo $row['email']; ?>">

                                        <button name="del_ac"><i class='bx bxs-trash-alt'></i></button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                } else { ?>
                    <!-- Deleting Accounts -->
                <?php } ?>

            </table>


        </div>
        <!-- Main Content OF Right Bar -->

    </div>


    <!-- Javascript file link here -->

</body>

</html>